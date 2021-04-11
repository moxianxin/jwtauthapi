<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
| app接口v1.0路由
*/

//需要中间件验证token
$router->group(['prefix' => 'v1', 'middleware' => 'jwt_auth'], function () use ($router) {

    $router->get('/user/info', 'V1\UserController@info');
    $router->get('/user/info-cache', 'V1\UserController@infoWithCache');

});

//不需要中间件验证token
$router->group(['prefix' => 'v1'], function () use ($router) {

    $router->get('/index', 'V1\TestController@index');
    $router->post('/login', 'V1\JwtLoginController@login');

});