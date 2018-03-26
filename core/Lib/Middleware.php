<?php

namespace Core\Lib;

class Middleware
{

    static $middlewareList = []; // 中间件别名

    static $queue = []; // 执行队列
    static $index = 0; // 当前执行索引位置

    public static function map($list)
    {
        self::$middlewareList = $list;
    }

    // 安装中间件
    public static function install($mid)
    {
        array_push(self::$queue, $mid);
    }

    // 依次调用中间件
    public static function next($request)
    {
        $handler = self::$queue[self::$index++];

        if (is_callable($handler)) {
            $handler($request, __METHOD__);
        }
    }

    // 批量注册
    public static function batchInstall($alias = [])
    {
        foreach ($alias as $item) {
            $ctrlName = self::$middlewareList[$item];
            try {
                $ctrl = new $ctrlName();
                // todo 没有找到PHP传递类方法的形式，临时处理，容我查查文档
                self::install(function ($request, $next) use ($ctrl) {
                    $ctrl->handle($request, $next);
                });
            } catch (\Exception $e) {
                var_dump($e->getMessage());
            }
        }
    }

    // 开始执行
    public static function start($cb)
    {
        $request = Request::getRequest();

        // 实际请求方法
        self::install($cb);
        self::next($request);
    }
}

