<?php

namespace Core\Lib;

class Request
{
    public static function getRequest()
    {
        // todo 封装请求对象
        return $_REQUEST;
    }
}