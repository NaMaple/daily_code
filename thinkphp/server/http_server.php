<?php

/**
 * 0.0.0.0 所有地址
 * 127.0.0.1 本机
 * 外网地址
 */

define("DOCUMENT_ROOT", "/Users/yintianxiong/PhpstormProjects/htdocs/daily_code/thinkphp/public/static");
define("NOW_TIME", date("Ymd H:i:s"));
define('APP_PATH', __DIR__ . '/../application/');

$http = new swoole_http_server("0.0.0.0", 8811);

/**
 * 设置http_server配置项
 */
$http->set(
    [
        'enable_static_handler' => true,
        'document_root' => DOCUMENT_ROOT, // 静态资源路径
        'worker_num' => 5,
    ]
);

/**
 * 通过swoole讲路由导入thinkphp框架
 * workerStart事件回调，此事件在Worker进程/Task进程启动时发生
 * swoole做http服务器
 */
$http->on('WorkerStart', function(swoole_server $server, $work_id) {
    // 加载框架引导文件
    require __DIR__ . '/../thinkphp/base.php';

    /**
     * Container::get('app', [defined('APP_PATH') ? APP_PATH : ''])->run()->send();
     * start执行控制器代码，worker进程里没有必要执行。只有热加载一些文件即可
     * 在request里面执行处理http请求的逻辑
     * 开启多个进程，每个进程载入一个thinkPHP框架
     */
//    require __DIR__ . '/../thinkphp/start.php';
});





$http->on('request', function($request, $response) {
//    $content = [
//        'data:' => NOW_TIME,
//        'get:' => $request->get,
//        'post:' => $request->post,
//        'header:' => $request->header,
//    ];

//    var_dump($request->server);

    if(isset($request->server)) {
        foreach ($request->server as $k=>$v) {
            $_SERVER[strtoupper($k)] = $v;
        }
    }

    if(isset($request->header)) {
        foreach ($request->header as $k=>$v) {
            $_SERVER[strtoupper($k)] = $v;
        }
    }

    // 清空超全局变量，sw适配框架
    if(!empty($_GET)){
        unset($_GET);
    }
    if(isset($request->get)) {
        foreach ($request->get as $k=>$v) {
            $_GET[$k] = $v;
        }
    }

    if(isset($request->post)) {
        foreach ($request->post as $k=>$v) {
            $_POST[$k] = $v;
        }
    }

//    var_dump($request);

    ob_start();
    /**
     * 常驻内存的坑
     * 路由已经找到正确的path_info，但是tp框架走入错误的函数
     * 不管是index()方法还是set()方法都进入了index()方法，坑
     */
    try {
        think\Container::get('app', [defined('APP_PATH') ? APP_PATH : ''])->run()->send();
    } catch (\Exception $e) {
        //todo 输出业务逻辑
    }

    /**
     * 查看tp调用的方法
     * 输出全是走的index()方法
     * http://127.0.0.1:8811/index/index/set
     * array(0) { } http_server加载start.php action:index
     *
     * http://127.0.0.1:8811/?s=index/index/set
     * string(3) "set" 1577120198 action:set
     * s=XX/XX/XX走到set方法
     *
     * tp中会把控制器名、类名、方法名放到变量，进程中不会被注销掉
     */
    echo PHP_EOL . "action:" . request()->action() . PHP_EOL;

    $res = ob_get_contents();
    ob_end_clean();
    $response->end($res);

    /**
     * kill掉sw进程，重启一个进程，粗暴的方法
     */
//    $http->close();


//    $response->cookie("cookie_key", "cookie_value", time() + 1800);
//    $response->end("end:" . json_encode($request->get));
});

/**
 * 开启http_server php http_server.php
 * 关闭http_server control+c
 */
$http->start();