<?php
/**
 * Created by PhpStorm.
 * User: edz
 * Date: 2019-07-11
 * Time: 11:42
 */

//创建Server对象，监听 127.0.0.1:9501端口
$serv = new swoole_server("127.0.0.1", 9501);

$serv->set(
    array(
        'worker_num' => 5,   //开启进程数 cpu 1-4
        'max_request' => 50, //每个worker允许最大
    )
);

/**
 * 监听连接进入事件，客户端连接
 * $fd 客户端连接的唯一标识
 * $reactor_id 线程id
 */
$serv->on('connect', function ($serv, $fd, $reactor_id) {
    echo "监听TCP连接进入事件，线程ID：{$reactor_id}；客户端ID：{$fd}\n";
});

/**
 * 监听数据接收事件
 * send 将数据发给客户端
 * $fd 客户端信息
 * $reactor_id 线程id
 */
$serv->on('receive', function ($serv, $fd, $reactor_id, $data) {
    $serv->send($fd, "监听TCP连接数据接收事件，线程ID：{$reactor_id}；客户端ID：{$fd}；接收的数据：{$data}\n");
});

/**
 * 监听连接关闭事件
 */
$serv->on('close', function ($serv, $fd) {
    echo "Client: Close.\n";
});

//启动服务器
$serv->start();