<?php
use \Core\Lib\Route;

// 回调函数
Route::bind(['/', 'index'], function () {
    echo 'hello index';
});

// 绑定控制器方法
Route::bind('test', '\App\Home\Controller\TestController@index');
