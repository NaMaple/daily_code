<?php
/**
 * Created by PhpStorm.
 * User: edz
 * Date: 2019-07-12
 * Time: 15:12
 */

//连接swoole tcp服务
$client = new swoole_client(SWOOLE_SOCK_TCP);

//连接到服务器
if (!$client->connect('127.0.0.1', 9501, 0.5))
{
    die("连接失败");
}

//输入数据
fwrite(STDOUT, '请输入消息：');
//获取数据
$msg = trim(fgets(STDIN));

//向服务器发送数据
if (!$client->send($msg))
{
    die("发送失败");
}
//从服务器接收数据
$data = $client->recv();
if (!$data)
{
    die("接受失败");
}
echo $data;
//关闭连接
$client->close();