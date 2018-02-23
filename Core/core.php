<?php

namespace Core;

use Core\Lib\Route;

class Core
{
    // 核心启动方法
    static public function run()
    {
        // 加载项目路由
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
    static public function load($class)
    {
        $class = str_replace('\\', '/', $class);
        $path = ROOT . '/' . $class . '.php';
        if (is_file($path)) {
            require_once $path;
        }
    }

}