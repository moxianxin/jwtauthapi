<?php

namespace App\Http\Controllers\V1;

use App\Http\Response\ResponseJson;
use App\Http\Controllers\Controller;

/**
 * Created by PhpStorm.
 * User: Xianxin
 * Date: 2021/3/29
 * Time: 22:25
 */

class TestController extends Controller
{
    use ResponseJson;

    public function index()
    {
        return $this->jsonSuccussData(['string'=>'hello world']);
    }

}
