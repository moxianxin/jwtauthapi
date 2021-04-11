<?php
namespace App\Http\Response;

/**
 * Created by PhpStorm.
 * User: Xianxin
 * Date: 2021/3/29
 * Time: 22:03
 */

trait ResponseJson
{

    /** 当App接口出现业务异常时返回
     * @param $code
     * @param $message
     * @param array $data
     * @return string
     */
    public function jsonData($code, $message, $data=[])
    {
        return $this->jsonResponse($code, $message, $data);
    }

    /**
     * App接口请求成功时的返回
     * @param array $data
     * @return string
     */
    public function jsonSuccussData($data=[])
    {
        return $this->jsonResponse(0, 'Success', $data);
    }

    /**
     * 返回一个json
     * @param $code
     * @param $message
     * @param $data
     * @return string
     */
    private function jsonResponse($code, $message, $data)
    {
        $content = [
            'code' => $code,
            'msg' => $message,
            'data' => $data
        ];

        return json_encode($content);
    }
}



