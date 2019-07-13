<?php
/**
 * Created by PhpStorm.
 * User: edz
 * Date: 2019-07-13
 * Time: 10:52
 */

$http = new swoole_http_server("0.0.0.0", 8811);

/**
 * 监听HTTP Server请求
 */
$http->on('request', function ($request, $response) {
    var_dump($request->get, $request->post);
    $response->header("Content-Type", "text/html; charset=utf-8");
    $response->end("<h1>Hello Swoole. #".rand(1000, 9999)."</h1>");
});

$http->start();