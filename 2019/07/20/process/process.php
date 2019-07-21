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
    //在子进程中启用一个HTTP服务
    //在Linux中执行PHP
    //__DIR__ 当前文件所在目录，到文件夹

    $phpPath = '/usr/local/opt/php@7.1/bin/php';
    $httpPath = __DIR__.'/../13/server/http.php';
    //HTTP启动不来
    $process->exec($phpPath, [$httpPath]);
    echo $httpPath . PHP_EOL;
}, false);

//启用一个子进程
$pid = $process->start();
echo $pid . PHP_EOL;

//回收子进程
swoole_process::wait();