<?php
namespace app\index\controller;
class Index
{
    public function index()
    {
        return 'http_server加载start.php' . PHP_EOL;
    }

    public function singwa() {
        echo time();
    }

    public function hello($name = 'ThinkPHP5')
    {
        echo 'hessdggsg' . $name.time();
    }

}
