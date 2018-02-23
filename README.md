petty-php
===
一个采用PHP实现的极简MVC框架

## Router

`Route::bind`
* `bind(url, cb)`绑定回调函数
* `bind('test', 'TestController@index')`绑定控制器方法

## Controller
Controller基类提供两个基本方法
* `assign`，向模板上添加变量
* `view`，加载视图

## Model
通过composer管理你喜欢的Model库

## View
通过composer管理你喜欢的模板引擎，或者使用原始的PHP模板标签