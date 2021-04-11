<?php
/**
 * Created by PhpStorm.
 * User: Xianxin
 * Date: 2021/4/11
 * Time: 22:06
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redis;

class RedisTestController extends Controller
{
    public function index()
    {
        Redis::set('uid', 123456);
        echo Redis::get('uid');
    }


}