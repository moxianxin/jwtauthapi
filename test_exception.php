<?php
/**
 * Created by PhpStorm.
 * User: Xianxin
 * Date: 2021/4/1
 * Time: 23:15
 */

try {
    throw new \Exception('try catch exception');
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}

function customExceptionHandle($e)
{
    echo $e->getMessage() . PHP_EOL;
}

//set_exception_handler('customExceptionHandle');

throw new \Exception('custom exception');