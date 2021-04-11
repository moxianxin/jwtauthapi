<?php
/**
 * Created by PhpStorm.
 * User: Xianxin
 * Date: 2021/4/1
 * Time: 22:23
 */

namespace App\Http\Controllers\V1;

use App\Common\Err\ApiErrDesc;
use App\Exceptions\ApiException;
use App\Http\Response\ResponseJson;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class UserController extends UserBaseController
{
    use ResponseJson;

    /**
     * 获取用户信息
     *
     * @return string
     */
    public function info()
    {
        //获取jwtAuth uid
        //$jwtAuth = JwtAuth::getInstance();
        //$uid = $jwtAuth->getUid();

        //使用uid查询用户信息返回
        $user = User::where('id', $this->uid)->first();
        if (!$user) {
            throw new ApiException(ApiErrDesc::ERR_USER_NOT_EXIST);
        }

        $userInfo = [
            'name' => $user->name,
            'email' =>  $user->email,
            'age' => $user->age
        ];
        return $this->jsonSuccussData($userInfo);
    }


    public function infoWithCache()
    {
        $cacheUserInfo = Redis::get('uid:'. $this->uid);
        if (!$cacheUserInfo) {
            $user = User::where('id', $this->uid)->first();
            if (!$user) {
                throw new ApiException(ApiErrDesc::ERR_USER_NOT_EXIST);
            }

            Redis::setex('uid:'.$this->uid, 3600, json_encode($user->toArray()));
        } else {
            $user = json_decode($cacheUserInfo);
        }

        $userInfo = [
            'name' => $user->name,
            'email' =>  $user->email,
            'age' => $user->age
        ];
        return $this->jsonSuccussData($userInfo);
    }

}