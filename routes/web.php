<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return view('request');
});

$router->get('/get-demo', function (){
    getParams();
});

function getParams()
{
    $id = $_GET['id'];
    $name = $_GET['name'];
    echo $id . '-' . $name;
}




$router->get('/redis/index', 'RedisTestController@index');