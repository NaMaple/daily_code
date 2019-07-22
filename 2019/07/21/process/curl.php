<?php
/**
 * Created by PhpStorm.
 * User: edz
 * Date: 2019-07-22
 * Time: 09:47
 */
$startTime = explode(' ', microtime());

$workers = [];
$urls = [
    'https://www.baidu.com',
    'https://blog.csdn.net/',
    'https://www.sina.com',
    'https://www.qq.com',
    'https://www.v2ex.com',
    'https://www.swoole.com',
    'https://yeasy.gitbooks.io'
];

//传统方式
//foreach ($urls as $url) {
//    $contents[] = file_get_contents($url);
//}
//var_dump($contents);

//swoole，开启七个子进程，每个子进程去处理一个
for ($i=0; $i<7; $i++) {
    //子进程
    $process = new swoole_process(function (swoole_process $worker) use ($i, $urls) {
        //curl
        $contents = curlData($urls[$i]);
        echo $contents;
    }, true);
    $pid = $process->start();
    $workers[$pid] = $process;
}

foreach ($workers as $worker) {
    echo $worker->read();
}

function curlData($url)
{
    file_get_contents($url);
    return $url . "-成功" . PHP_EOL;
}


$endTime = explode(' ', microtime());

echo $startTime[0] + $startTime[1] . "\n";
echo $endTime[0] + $endTime[1] . "\n";
echo '执行耗时：' . round($endTime[0] + $endTime[1] - ($startTime[0] + $startTime[1]), 4) . " 秒。\n";