<?php

/**
 * Class IndexController
 * @package App\Modules\Systems\Controllers\Web
 * @author Electric <huydien.it@gmail.com>
 */

namespace App\Modules\Systems\Controllers\Web;

use App\Http\Controllers\Web\AbstractWebController;

class DashboardController extends AbstractWebController
{
    public function __construct()
    {

    }

    public function homepage()
    {
        return view('Systems::homepage');
    }
}
