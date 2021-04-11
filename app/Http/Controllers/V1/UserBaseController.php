<?php
/**
 * Created by PhpStorm.
 * User: Xianxin
 * Date: 2021/4/11
 * Time: 21:12
 */
namespace App\Http\Controllers\V1;

use App\Common\Auth\JwtAuth;
use App\Http\Response\ResponseJson;
use Laravel\Lumen\Routing\Controller as BaseController;

class UserBaseController extends BaseController
{
    use ResponseJson;

    public $uid;

    public function __construct()
    {
        $this->uid = JwtAuth::getInstance()->getUid();
    }
}