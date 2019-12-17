<?php

/**
 * 0.0.0.0 所有地址
 * 127.0.0.1 本机
 * 外网地址
 */

define("DOCUMENT_ROOT", "/Users/yintianxiong/PhpstormProjects/htdocs/daily_code/thinkphp/public/static");
define("NOW_TIME", date("Ymd H:i:s"));

$http = new swoole_http_server("0.0.0.0", 8811);

/**
 * 设置http_server配置项
 */
$http->set(
    [
        'enable_static_handler' => true,
        'document_root' => DOCUMENT_ROOT, // 静态资源路径
    ]
);

$http->on('request', function($request, $response) {
    $content = [
        'data:' => NOW_TIME,
        'get:' => $request->get,
        'post:' => $request->post,
        'header:' => $request->header,
    ];

    $response->cookie("cookie_key", "cookie_value", time() + 1800);
    $response->end("end:" . json_encode($request->get));
});

/**
 * 开启http_server php http_server.php
 * 关闭http_server
 */
$http->start();