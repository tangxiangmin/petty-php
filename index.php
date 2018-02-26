<?php

// 定义路径常量
define('ROOT', dirname(__FILE__));
define('CORE', ROOT . '/core');
define('APP', ROOT . '/app');

// 调试模式
ini_set('display_errors', '1');

// 加载核心文件
require 'vendor/autoload.php';

require CORE . '/init.php';
require ROOT . '/diy.php';
