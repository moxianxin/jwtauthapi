<?php
/**
 * Created by PhpStorm.
 * Desc API 异常捕捉
 * User: Xianxin
 * Date: 2021/4/1
 * Time: 23:25
 */

namespace App\Exceptions;

use Throwable;

class ApiException extends \RuntimeException
{
    public function __construct(array $apiErrConst, Throwable $previous = null)
    {
        $code = $apiErrConst[0];
        $message = $apiErrConst[1];
        parent::__construct($message, $code, $previous);
    }
}