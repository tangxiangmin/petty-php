<?php

namespace Core\Lib\Route;


class Route
{
    public $group = '';
    public $ctrl = '';
    public $action = '';


    static $routes = [];

    static $prefix = '';
    static $namespace = '';
    static $middleware = [];

    // 添加单条路由记录
    static function addRoute($url, $action)
    {
        $prefix = self::$prefix;
        $namespace = self::$namespace;
        $middleware = self::$middleware;

        if ($prefix) {
            $url = $prefix . '/' . $url;
        }

        if ($namespace) {
            $action = $namespace . '\\' . $action;
        }

        if (is_callable($action)) {
            self::$routes[$url] = $action;
        } else {
            self::$routes[$url] = new RouteItem($action, $middleware);
        }
    }

    // 路由分组重置
    static function reset()
    {
        self::$prefix = '';
    }

    // api
    static function getRoute()
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

        // 如果是路由，则加载相应控制器
        return $route;
    }

    /**
     * @param $url 'index'
     * @param $action '\App\Home\Controller\TestController@index'
     */
    static function bind($url, $action)
    {
        if (is_array($url)) {
            foreach ($url as $u) {
                self::addRoute($u, $action);
            }
        } else {
            self::addRoute($url, $action);
        }
    }

    static function group($config, $cb)
    {
        foreach ($config as $key => $item) {
            self::$$key = $item;
        }

        $cb();
        self::reset();
    }
}