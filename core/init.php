<?php

namespace Core;

use Core\Lib\Middleware;
use Core\Lib\Route\Route;

class Core
{
    // 启动方法
    static public function run()
    {
        self::autoload();

        self::init();
    }

    // 初始化
    static function init()
    {
        $route = self::getRoute();

        // 注册中间件
        self::registerMiddleware($route->middleware);

        Middleware::start(function ($request) use ($route) {
            $ctrlName = $route->controller;
            $action = $route->action;

            try {
                $ctrl = new $ctrlName();
                $ctrl->$action($request);
            } catch (\Exception $e) {
                var_dump($e->getMessage());
            }
        });
    }

    // 获取路由
    private static function getRoute()
    {
        include_once APP . '/route.php';
        return Route::getRoute();
    }

    // 初始化中间件
    private static function registerMiddleware(Array $alias = [])
    {
        include_once APP . '/middleware.php';
        Middleware::batchInstall($alias);
    }

    // 实现自动加载类
    private static function autoload()
    {
        spl_autoload_register(function ($class) {
            $class = str_replace('\\', '/', $class);
            $path = ROOT . '/' . $class . '.php';
            if (is_file($path)) {
                require_once $path;
            }
        });
    }
}

// 启动程序
Core::run();