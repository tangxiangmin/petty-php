<?php

namespace Core\Lib;


use App\Provider;

class Controller
{
    private $assignArr = [];

    public function assign($key, $val)
    {
        $this->assignArr[$key] = $val;
    }

    public function view($file)
    {
        try {
            extract($this->assignArr);
            Provider::loadView($file);
        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }
    }
}