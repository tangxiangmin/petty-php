<?php

namespace Core;

interface petty
{
    /**
     * @param $file 模板路径
     * @return mixed 模板输出内容
     */
    public static function loadView($file);
}

class BasePetty implements petty
{
    static function loadView($file)
    {
        require $file;
    }
}