<?php

// 注册中间件

use Core\Lib\Middleware;

Middleware::map([
    'test' => '\App\Middleware\Test'
]);
