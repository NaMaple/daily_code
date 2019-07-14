<?php
/**
 * Created by PhpStorm.
 * User: edz
 * Date: 2019-07-13
 * Time: 23:26
 */

//创建websocket服务器对象，监听0.0.0.0:9502端口
$ws = new swoole_websocket_server("0.0.0.0", 9502);

//$ws->set([]);

//监听WebSocket连接打开事件
//$ws->on('open', function ($ws, $request) {
//    var_dump($request->fd, $request->get, $request->server);
//    $ws->push($request->fd, "hello, welcome\n");
//});
/**
 * $fd客户端连接ID
 */
$ws->on('open', 'onOpen');
function onOpen($ws, $request){
    var_dump($request->fd, $request->get, $request->server);
    //push到客户端
    $ws->push($request->fd, "WEB_SOCKET连接\n");
}


//监听WebSocket消息事件
$ws->on('message', function ($ws, $frame) {
    echo "Message: {$frame->data}\n";
    //push到客户端
    $ws->push($frame->fd, "server: {$frame->data}");
});

//监听WebSocket连接关闭事件
$ws->on('close', function ($ws, $fd) {
    echo "client-{$fd} is closed\n";
});

$ws->start();