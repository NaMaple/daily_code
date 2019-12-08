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
                'worker_num'      => 8,
                'daemonize'       => false,
                'max_request'     => 100000,
                'dispathch_mode'  => 2,
                'task_worker_num' => 8
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

        public function onStart($server)
        {
            echo "start\n";
        }

        public function onConnect($server, $fd, $from_id)
        {
            echo "Client {$fd} connection\n";
        }

        public function onClose($server, $fd, $from_id)
        {
            echo "Client {$fd} close connection\n";
        }

        public function onReceive(swoole_server $server, $fd, $from_id, $data)
        {
            echo "Get Message From Client {$fd}:{$data}\n";

        }

        public function onTask($server, $task_id, $from_id, $data)
        {
            echo "This Task {$task_id} from Worker {$from_id}\n";
            echo "Data:{$data}\n";
        }

        public function onFinish($server, $task_id, $data)
        {
            echo "Task {$task_id} finish\n";
            echo "Result:{$data}\n";
        }
    }

    $server = new Server();
