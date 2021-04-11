<?php

/**
 * Created by PhpStorm.
 * User: Xianxin
 * Date: 2021/3/31
 * Time: 23:25
 */

namespace App\Http\Controllers\V1;

use App\Common\Auth\JwtAuth;
use App\Common\Err\ApiErrDesc;
use App\Exceptions\ApiException;
use App\Http\Response\ResponseJson;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class JwtLoginController extends BaseController
{
    use ResponseJson;

    /**
     * 用户登录
     *
     * @param Request $request
     * @return string
     */
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        //去数据库或者缓存验证用户
        $user = User::where('email', $email)->first();

        if (!$user) {
            throw new ApiException(ApiErrDesc::ERR_USER_NOT_EXIST);
        }

        // 验证password_hash密码
        $userPasswordHash = $user->password;
        if (!password_verify($password, $userPasswordHash)) {
            throw new ApiException(ApiErrDesc::ERR_PASSWORD);
        }

        $jwtAuth = JwtAuth::getInstance();
        $token = $jwtAuth->setUid($user->id)->encode()->getToken();

        return $this->jsonSuccussData([
            'token' => $token
        ]);
    }

}
