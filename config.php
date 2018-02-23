<?php
/**
 * Created by PhpStorm.
 * User: Txm
 * Date: 2018/2/23
 * Time: 18:57
 */
use Philo\Blade\Blade;

class DIY
{
    public static function loadView($file)
    {
        $views = ROOT . '/views';
        $cache = ROOT . '/cache';
        $blade = new Blade($views, $cache);

        echo $blade->view()->make($file)->render();
    }
}
