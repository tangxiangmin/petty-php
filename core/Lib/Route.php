<?php

namespace Core\Lib;
class Route
{
    public $group = '';
    public $ctrl = '';
    public $action = '';

    static $routes = [];
    static $prefix = '';
    static $namespace = '';

    // 添加单条路由记录
    static function addRoute($url, $action)
    {
        $prefix = self::$prefix;
        $namespace = self::$namespace;

        if ($prefix) {
            $url = $prefix . '/' . $url;
        }

        if ($namespace) {
            $action = $namespace . '\\' . $action;
        }

        self::$routes[$url] = $action;
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
        if (is_string($route)) {
            $server = explode('@', $route);
            return array(
                'controller' => $server[0],
                'action'     => $server[1]
            );
        }
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