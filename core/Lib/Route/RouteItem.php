<?php

namespace Core\Lib\Route;

class RouteItem
{
    public $controller = '';
    public $action = '';

    public function __construct($route, $middleware = [])
    {
        $this->route = $route;
        $this->middleware = $middleware;

        $this->parseUrl();
    }

    // 将对应的url转换成对应的控制器方法
    private function parseUrl()
    {
        $server = explode('@', $this->route);

        $this->controller = $server[0];
        $this->action = $server[1];
    }
}