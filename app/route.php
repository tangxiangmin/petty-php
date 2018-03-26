<?php
use \Core\Lib\Route\Route;

// 回调函数
Route::bind(['/', 'index'], function () {
    echo 'hello index';
});

// 绑定控制器方法
Route::bind('test', '\App\Home\Controller\TestController@index');

Route::group([
    'prefix'     => 'api',
    'namespace'  => '\App\Home\Controller',
    'middleware' => ['test']
], function () {
    Route::bind('test', 'TestController@test');
});

Route::group([
    'prefix'    => 'api2',
    'namespace' => '\App\Home\Controller'
], function () {
    Route::bind('test2', 'TestController@test2');
});