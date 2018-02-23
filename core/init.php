<?php

namespace Core;

use Core\Lib\Route;

class Core
{
    // 启动方法
    static public function run()
    {
        self::autoload();
        self::parseRoute();
    }

    private static function parseRoute()
    {
        // 加载项目路由
        // todo 添加可配置化的路由文件
        include_once APP . '/route.php';

        $url = Route::getRoute();

        $ctrlName = $url['controller'];
        $action = $url['action'];

        try {
            $ctrl = new $ctrlName();
            $ctrl->$action();
        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }
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