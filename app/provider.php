<?php

namespace App;

use Core\BasePetty;
use Philo\Blade\Blade;

class Provider extends BasePetty
{
    // 在这里重写视图加载的方法
    public static function loadView($file)
    {
        $views = ROOT . '/views';
        $cache = ROOT . '/cache';
        $blade = new Blade($views, $cache);

        echo $blade->view()->make($file)->render();
    }
}
