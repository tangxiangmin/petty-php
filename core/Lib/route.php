<?php

namespace Core\Lib;
class Route
{
    public $group = '';
    public $ctrl = '';
    public $action = '';

    // 默认
    static public $routes = [];

    public static function getRoute()
    {
        $url = $_SERVER['REQUEST_URI'];

        if ($url != '/') {
            $url = trim($url, '/');
        }
        $route = self::$routes[$url];

        // 如果是闭包，则执行
        if (is_callable($route)) {
            exit($route());
        }

        // 如果是MVC路由，则加载相应控制器
        if (is_string($route)) {
            $server = explode('@', $route);
            return array(
                'controller' => $server[0],
                'action'     => $server[1]
            );
        }
    }

    static public function bind($url, $action)
    {
        // todo 目前只实现了基础的路由加载
        if (is_array($url)) {
            foreach ($url as $u) {
                self::$routes[$u] = $action;
            }
        } else {
            self::$routes[$url] = $action;
        }
    }
}