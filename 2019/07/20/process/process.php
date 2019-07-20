<?php
/**
 * Created by PhpStorm.
 * User: edz
 * Date: 2019-07-20
 * Time: 14:33
 */

/**
 * process.php是一个主进程
 */
$process = new swoole_process(function(swoole_process $process){
    echo "不会打印在屏幕中". PHP_EOL;
    //在进程中启用一个HTTP服务

}, false);

//启用一个子进程
$pid = $process->start();
echo $pid . PHP_EOL;

