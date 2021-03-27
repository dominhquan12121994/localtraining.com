<?php
namespace App\Helpers;

class Func
{
    public static function getMicroTime(){
        return microtime(true) * 1000;
    }

    public function logError($message){
        \Log::error($message);
    }
}
