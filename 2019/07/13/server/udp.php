<?php
/**
 * Created by PhpStorm.
 * User: edz
 * Date: 2019-07-12
 * Time: 22:58
 */

//创建Server对象，监听 127.0.0.1:9502端口，类型为SWOOLE_SOCK_UDP
$serv = new swoole_server("127.0.0.1", 9502, SWOOLE_PROCESS, SWOOLE_SOCK_UDP);

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
    echo "监听UDP连接进入事件，线程ID：{$reactor_id}；客户端ID：{$fd}\n";
});

//监听数据接收事件
$serv->on('Packet', function ($serv, $data, $clientInfo) {
//    $serv->sendto($clientInfo['address'], $clientInfo['port'], "Server ".$data);
    $serv->sendto($clientInfo['address'], $clientInfo['port'],  "监听UDP连接数据接收事件，客户端地址：{$clientInfo['address']}；客户端端口：{$clientInfo['port']}；接收的数据：{$data}\n");
    var_dump($clientInfo);
});

//启动服务器
$serv->start();