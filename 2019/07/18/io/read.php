<?php
/**
 * Created by PhpStorm.
 * User: NaMaple
 * Date: 2019-07-18
 * Time: 18:00
 */

/*
 * 读取文件
 * __DIR__ 当前文件所在目录，到文件夹
 */
swoole_async_readfile(__DIR__.'/1.txt', function($filename, $fileContents){
    echo "filename：{$filename}，fileContents：{$fileContents}".PHP_EOL; // \n \r \r\n
});
