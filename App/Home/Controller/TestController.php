<?php

namespace App\Home\Controller;

use Core\Lib\Controller;

class TestController extends Controller
{
    public function index()
    {

        $this->assign('msg', 'Hello from action');

        $this->view(APP.'/Home/View/test.php');
    }
}