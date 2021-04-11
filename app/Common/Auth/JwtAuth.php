<?php
/**
 * Created by PhpStorm.
 * User: Xianxin
 * Date: 2021/3/29
 * Time: 23:15
 */

namespace App\Common\Auth;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\ValidationData;

/**
 * 单例  一次请求中所有出现使用jwt的地方都是一个用户
 *
 * Class JwtAuth
 * @package App\Common\Auth
 */
class JwtAuth
{
    /**
     * jwt token
     * @var
     */
    private $token;

    /**
     * claim iss
     * @var string
     */
    private $iss = 'api.test.com';

    /**
     * claim aud
     * @var string
     */
    private $aud = 'mxx_server_app';

    /**
     * claim uid
     * @var
     */
    private $uid;

    /**
     * secrect
     * @var string
     */
    private $secrect = '@$%&d$*&!#fsfsdfs@$&';

    /**
     * deco token
     * @var
     */
    private $decodeToken;

    /**
     * 单例模式 jwtAuth句柄
     * @var
     */
    private static $instance;

    /** 获取JwtAuth的句柄
     * @return JwtAuth
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 私有化构造函数，防止实例化此类
     * JwtAuth constructor.
     */
    private function __construct()
    {
    }

    /**
     * 私有化克隆函数，防止克隆此类
     */
    private function __clone()
    {
    }

    /**
     * 获取token
     * @return string
     */
    public function getToken()
    {
        return (string)$this->token;
    }

    /**
     * 设置token
     * @param $token
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * 设置uid
     * @param $uid
     * @return $this
     */
    public function setUid($uid)
    {
        $this->uid = $uid;

        return $this;
    }

    /**
     * 获取uid
     * @return mixed
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * 编码jwt token
     * 设置一系列元素得到一个token对象
     * @return $this
     */
    public function encode()
    {
        $time = time();
        $this->token = (new Builder())->setHeader('alg','HS256')
            ->setIssuer($this->iss)
            ->setAudience($this->aud)
            ->setIssuedAt($time)
            ->setExpiration($time+3600)
            ->set('uid', $this->uid)
            ->sign(new Sha256(), $this->secrect)
            ->getToken();

        return $this;

    }

    /**
     * parse string token
     * 解码jwt token
     * @return \Lcobucci\JWT\Token
     */
    public function decode()
    {
        if (!$this->decodeToken) {
            $this->decodeToken = (new Parser())->parse((string)$this->token);
            $this->uid = $this->decodeToken->getClaim('uid');
        }

        return $this->decodeToken;
    }

    /**
     * verify token
     * 验证数据是否被篡改
     * @return bool
     */
    public function verify()
    {
        $result = $this->decode()->verify(new Sha256(), $this->secrect);

        return $result;
    }

    /**
     * validate
     * 验证token iss、aud，是否过期
     * @return bool
     */
    public function validate()
    {
        $data = new ValidationData();
        $data->setIssuer($this->iss);
        $data->setAudience($this->aud);

        return $this->decode()->validate($data);
    }

}