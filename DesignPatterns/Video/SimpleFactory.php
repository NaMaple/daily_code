<?php

/**
 * 服务端打包开始
 * 面向接口开发，规范开发，共同接口
 */
interface db {
    function connect();
}

/**
 * 服务端开发（不知道被谁调用）
 * 只要实现接口即可，有点拆分项目的意思
 */
class dbMysql implements db{
    public function connect()
    {
        echo '连接上MySQL数据库' . PHP_EOL;
    }
}

class dbSqlite implements db{
    public function connect()
    {
        echo '连接上Sqlite数据库' . PHP_EOL;
    }
}




/**
 * 客户端开发，看不到dbMysql、dbSqlite细节，只知道这两个类实现了DB接口
 * 客户端怎么知道这两个类，服务端还是开放的信息太多。知道的越少越好
 */
//$dbM = new dbMysql();
//$dbM->connect();
//
//$dbS = new dbSqlite();
//$dbS->connect();

/**
 * 简单工厂模式
 */
class Factory {
    public static function createDB($type) {
        if ($type == 'mysql') {
            return new dbMysql();
        } elseif ($type == 'sqlite') {
            return new dbSqlite();
        } else {
            throw new Exception('Error DB Type', 1);
        }
    }
}

/**
 * 客户端不知道服务器端到底有哪些类，把类名隐藏了
 * 只知道对方开发了一个Factory::createDB方法
 * 方法只允许传递数据库名称
 *
 * 新增oracle类型，服务端需要修改Factory内容
 * 在OOD（面向对象思想）中有一个开闭原则，对于修改是封闭的，对于扩展是开放的。
 * 换一个子类实现
 */

//$mysql = Factory::createDB('mysql');
$mysql = Factory::createDB('sqlite');
$mysql->connect();