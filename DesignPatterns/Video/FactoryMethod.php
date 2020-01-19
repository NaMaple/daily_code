<?php

interface db {
    function connect();
}

/**
 * 新增一个工厂借口类
 * 返回一个创造好的DB类
 */
interface factory {
    function createDB();
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

class mysqlFactory implements factory {
    public function createDB()
    {
        return new dbMysql();
    }
}

class sqliteFactory implements factory {
    public function createDB()
    {
        return new dbSqlite();
    }
}

/**
 * 客户端
 * 先实例化工厂对象
 * 在工厂对象里实例化数据库对象
 * 在数据库对象调用连接
 */
$mysqlFactory = new mysqlFactory();
$db = $mysqlFactory->createDB();
$db->connect();

$sqliteFactory = new sqliteFactory();
$db = $sqliteFactory->createDB();
$db->connect();
