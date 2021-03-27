<?php
/**
 * Copyright (c) 2020. Electric
 */

namespace App\Modules\Orders\Controllers\Api;

use App\Http\Controllers\Api\AbstractApiController;
use App\Modules\Orders\Models\Entities\OrderShop;
use App\Modules\Orders\Models\Entities\PasswordReset;
use App\Modules\Orders\Notifications\ResetPasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AuthController extends AbstractApiController
{
    /**
     * Create shop
     *
     * @param  [string] name
     * @param  [string] phone
     * @param  [string] email
     * @param  [string] address
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function register (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255|unique:order_shops',
            'email' => 'required|string|email|max:255|unique:order_shops',
            'address' => 'string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $request['password']=Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);
        $user = User::create($request->toArray());
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        $response = ['token' => $token];
        return response($response, 200);
    }

    /**
     * Login shop and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $shop = OrderShop::where('email', $request->email)->first();
        if ($shop) {
            if (Hash::check($request->password, $shop->password)) {
                $tokenResult = $shop->createToken('Personal Access Token');
                $token = $tokenResult->token;
                if ($request->remember_me)
                    $token->expires_at = Carbon::now()->addWeeks(1);
                $token->save();
                return response()->json([
                    'access_token' => $tokenResult->accessToken,
                    'token_type' => 'Bearer',
                    'expires_at' => Carbon::parse(
                        $tokenResult->token->expires_at
                    )->toDateTimeString()
                ]);
            } else {
                return response()->json([
                    'message' => 'Password mismatch'
                ], 401);
            }
        } else {
            return response()->json([
                'message' => 'User does not exist'
            ], 401);
        }
    }

    /**
     * Logout shop (Revoke the token)
     *
     * @return [string] message
     */
    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }

    /**
     * Get the authenticated shop
     *
     * @return [json] shop object
     */
    public function get(Request $request)
    {
        return response()->json($request->user());
    }

    /**
     * Create token password reset.
     *
     * @param  ResetPasswordRequest $request
     * @return JsonResponse
     */
    public function sendMail(Request $request)
    {
        $user = OrderShop::where('email', $request->email)->firstOrFail();
        $passwordReset = PasswordReset::updateOrCreate([
            'email' => $user->email,
        ], [
            'token' => Str::random(60),
        ]);
        if ($passwordReset) {
            $user->notify(new ResetPasswordRequest($passwordReset->token));
        }

        return response()->json([
        'message' => 'We have e-mailed your password reset link!'
        ]);
    }

    public function reset(Request $request, $token)
    {
        $passwordReset = PasswordReset::where('token', $token)->firstOrFail();
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();

            return response()->json([
                'message' => 'This password reset token is invalid.',
            ], 422);
        }
        $user = OrderShop::where('email', $passwordReset->email)->firstOrFail();
        $updatePasswordUser = $user->update($request->only('password'));
        $passwordReset->delete();

        return response()->json([
            'success' => $updatePasswordUser,
        ]);
    }
}