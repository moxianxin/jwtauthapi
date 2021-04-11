<?php

namespace App\Exceptions;

use App\Common\Err\ApiErrDesc;
use App\Http\Response\ResponseJson;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ResponseJson;

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     * 没有经过try catch捕获的异常都会走这里来
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        //return parent::render($request, $exception);

        if ($exception instanceof ApiException) {
            $code = $exception->getCode();
            $message = $exception->getMessage();
        } else {
            $code = $exception->getCode();
            if (!$code || $code < 0) {
                $code = ApiErrDesc::UNKNOWN_ERR[0];
            }
            $message = $exception->getMessage() ?: ApiErrDesc::UNKNOWN_ERR[1];
        }

        return $this->jsonData($code, $message);
    }
}
