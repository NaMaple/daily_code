<?php
/**
 * Created by PhpStorm.
 * User: edz
 * Date: 2019-07-13
 * Time: 11:52
 */

/**
 * 0.0.0.0 所有地址
 * 127.0.0.1 本机
 * 外网地址
 */
// 实例化对象

$http = new swoole_http_server("0.0.0.0", 8811);
//$http = new Swoole\Http\Server("127.0.0.1", 9501);
//$http->set(
//    [
//        'enable_static_handler' => true,
//        'document_root' => "/Users/edz/htdocs/daily_code/2019/07/13/static",
//    ]
//);

/**
 * 监听HTTP Server请求
 * $request 请求
 * $response 响应
 */
$http->on('request', function ($request, $response) {
    $requestMethod = $request->server['request_method'];
    $response->header("Content-Type", "text/html; charset=utf-8");
    $response->cookie("key", "value", time()+1800);
    $requestParam = $requestParamFor = $requestMethod=='GET' ? $request->get : $request->post;
    $requestParamStr = "请求的参数：";
    if ($requestParam) {
        end($requestParam);
        $keyLast = key($requestParam);
        foreach ($requestParamFor as $k=>$v) {
            if ($keyLast != $k) {
                $requestParamStr .= "{$k}：{$v}；";
            } else {
                $requestParamStr .= "{$k}：{$v}";
            }
        }
    }

    $responseContent  = "<h1>请求方式为：{$requestMethod}</h1>\n";
    $responseContent .= "<h1>请求参数为：{$requestParamStr}</h1>\n";
    $responseContent .= "<h1>响应内容发送给浏览器".rand(1000, 9999)."</h1>\n";
    $response->end($responseContent);
});

$http->start();