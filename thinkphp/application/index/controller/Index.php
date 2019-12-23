<?php
namespace app\index\controller;
class Index
{
    public function index()
    {
        var_dump($_GET);
        return 'http_server加载start.php' . PHP_EOL;
    }

    public function set()
    {
        var_dump($_GET);
        var_dump('set');
        return time();
    }

    public function hello($name = 'ThinkPHP5')
    {
        /**
         * hellozhang
         * todo index()中name=zhang，访问了index再访问hello，name变成了zhang?
         */
        var_dump($_GET);
        var_dump('hello');
        return 'hello ' . $name . time() . PHP_EOL;
    }

}
