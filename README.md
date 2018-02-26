petty-php
===
一个参考Laravel实现的极简MVC框架

## Router

**API**

`Route::bind`
* `bind(url, cb)`绑定回调函数
* `bind('test', 'TestController@index')`绑定控制器方法

`Route::group($config, $cb)`
* `prefix`路由前缀
* `namespace`控制器命名空间

**TODO**

* [ ] get、post等快捷注册方式
* [x] 路由分组
* [ ] 路由中间件
* [ ] 路由参数接口


## Controller
Controller基类提供两个基本方法
* `assign`，向模板上添加变量
* `view`，加载视图

## Model
通过composer管理你喜欢的Model库

## View
通过composer管理你喜欢的模板引擎，或者使用原始的PHP模板标签

## 自定义
`/DIY类`中实现相关的接口方法，自定义相关的依赖库
* `loadView`模板引擎