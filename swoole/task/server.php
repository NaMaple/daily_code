<?php

    class Task
    {
        public $index = 0;
    }

    class Server
    {
        private $server;

        public function __construct()
        {
            $this->server = new swoole_server("0.0.0.0", 9501);
            $this->server->set(array(
                'worker_num'      => 2, //开启2个worker进程
                'max_request'     => 4, //每个worker进程 max_request设置为4次
                'task_worker_num' => 4, //开启4个task进程
                'dispatch_mode'   => 2, //数据包分发策略 - 固定模式
            ));
            $this->server->on('Start', array($this, 'onStart'));
            $this->server->on('Connect', array($this, 'onConnect'));
            $this->server->on('Receive', array($this, 'onReceive'));
            $this->server->on('Close', array($this, 'onClose'));
            //bind callback
            $this->server->on('Task', array($this, 'onTask'));
            $this->server->on('Finish', array($this, 'onFinish'));

            $this->server->start();
        }

        public function onStart($server) {
            echo "#### onStart ####".PHP_EOL;
            echo "SWOOLE ".SWOOLE_VERSION . " 服务已启动".PHP_EOL;
            echo "master_pid: {$server->master_pid}".PHP_EOL;
            echo "manager_pid: {$server->manager_pid}".PHP_EOL;
            echo "########".PHP_EOL.PHP_EOL;
        }

        public function onConnect($server, $fd) {
            echo "#### onConnect ####".PHP_EOL;
            echo "客户端:".$fd." 已连接".PHP_EOL;
            echo "########".PHP_EOL.PHP_EOL;
        }

        // 任务投递
        public function onReceive($server, $fd, $from_id, $data) {
            echo "#### onReceive ####".PHP_EOL;
            echo "worker_pid: {$server->worker_pid}".PHP_EOL;
            echo "客户端:{$fd} 发来的Email:{$data}".PHP_EOL;
            $param = [
                'fd'    => $fd,
                'email' => $data
            ];
            $rs = $server->task(json_encode($param));
            if ($rs === false) {
                echo "任务分配失败 Task ".$rs.PHP_EOL;
            } else {
                echo "任务分配成功 Task ".$rs.PHP_EOL;
            }
            echo "########".PHP_EOL.PHP_EOL;
        }

        // 收到任务
        public function onTask($server, $task_id, $from_id, $data) {
            echo "#### onTask ####".PHP_EOL;
            echo "#{$server->worker_id} onTask: [PID={$server->worker_pid}]: task_id={$task_id}".PHP_EOL;

            //业务代码
            for($i = 1 ; $i <= 5 ; $i ++ ) {
                sleep(2);
                echo "Task {$task_id} 已完成了 {$i}/5 的任务".PHP_EOL;
            }

            $data_arr = json_decode($data, true);
            $server->send($data_arr['fd'] , 'Email:'.$data_arr['email'].',发送成功');
            $server->finish($data);
            echo "########".PHP_EOL.PHP_EOL;
        }

        public function onFinish($server,$task_id, $data) {
            echo "#### onFinish ####".PHP_EOL;
            echo "Task {$task_id} 已完成".PHP_EOL;
            echo "########".PHP_EOL.PHP_EOL;
        }

        public function onClose($server, $fd) {
            echo "Client Close.".PHP_EOL;
        }
    }

    $server = new Server();
