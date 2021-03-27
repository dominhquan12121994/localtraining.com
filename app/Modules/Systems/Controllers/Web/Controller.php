<?php
/**
 * Copyright (c) 2020. Electric
 */

namespace App\Modules\Systems\Controllers\Web;

use Illuminate\Foundation\Bus\DispatchesJobs;
//use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Web\AbstractWebController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends AbstractWebController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function _responseError($message = 'Xảy ra lỗi vui lòng thử lại', $appendData = array(), $statusCode = 400)
    {
        return response()->responseError($message, $appendData, $statusCode);
    }

    protected function _responseSuccess($message = 'Success', $appendData = array(), $statusCode = 200)
    {
        return response()->responseMessage($message, $appendData, $statusCode);
    }

    protected function _responseWarning($message = 'Success', $appendData = array(), $statusCode = 200, $success = false)
    {
        return response()->responseMessage($message, $appendData, $statusCode, $success);
    }

    protected function _responseMessage($message = 'Success', $statusCode = 200)
    {
        return response()->responseMessage($message, [], $statusCode);
    }

}
