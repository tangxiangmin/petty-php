<?php

namespace App\Home\Controller;

use Core\Lib\Controller;

class TestController extends Controller
{
    public function index()
    {
        $this->assign('msg', 'Hello from action');
        $this->view('test');
    }

    public function test()
    {
        echo 'hello test';
    }

    public function test2()
    {
        echo 'hello test2';
    }
}