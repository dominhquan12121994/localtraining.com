<?php
/**
 * Define route for module
 * @author Electric <huydien.it@gmail.com>
 */

Route::group([
    'prefix' => 'shop'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('reset-password', 'AuthController@sendMail');
    Route::get('reset-password/{token}', 'AuthController@reset');

    Route::group([
        'middleware' => 'auth:shop'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('get', 'AuthController@get');
    });
});