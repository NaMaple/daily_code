<?php
    define ('PHP_URL', "/usr/bin/php");

    /* process.php就是父进程
     * 创建对象
     *
     * Process::__construct(
     *  callable $function,
     *  bool $redirect_stdin_stdout = false, false 屏幕打印输出内容
     *  int $pipe_type = SOCK_DGRAM,
     *  bool $enable_coroutine = false
     * )
     *
     */
    $process = new swoole_process(function(swoole_process $pro) {
        // todo
        //echo 111 . PHP_EOL;
        /*
         * 执行外部程序
         * php redis.php
         * php要安装的绝对路径，可用常量代替
         */
        echo PHP_URL . PHP_EOL;
        $pro->exec(PHP_URL, [__DIR__ . '/../server/http_server.php']);
    }, false);
    /*
     * 创建子进程
     * 子进程可以创建HTTP server
     */
    $pid = $process->start();
    // 打印子进程id
    echo $pid . PHP_EOL;

    swoole_process::wait();