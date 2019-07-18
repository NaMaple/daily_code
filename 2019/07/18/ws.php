<?php
/**
 * Ws 优化 基础类库
 * User: NaMaple
 * Date: 2019-07-18
 * Time: 15:45
 */

class Ws{

    const HOST = '0.0.0.0';

    const PORT = 9502;

    public $ws = null;

    public function __construct()
    {
        $this->ws = new swoole_websocket_server(self::HOST, self::PORT);
        $this->ws->on("open", [$this, 'onOpen']);
        $this->ws->on("message", [$this, 'onMessage']);
        $this->ws->on("close", [$this, 'onClose']);
        $this->ws->start();
    }

    /**
     * 监听ws连接事件
     * @param $ws
     * @param $request
     */
    public function onOpen($ws, $request)
    {
        if($request->fd == 1) {
            // 每2s执行
            swoole_timer_tick(2000, function($timer_id){
                echo "连接事件，间隔2s：定时器ID：{$timer_id}，时间为：".date('H:i:s', time())."\n";
            });
        }

        //push到客户端
        $ws->push($request->fd, "监听到连接事件，连接成功\n");
    }

    /**
     * 监听ws消息事件
     * @param $ws
     * @param $frame
     */
    public function onMessage($ws, $frame)
    {
        //服务端打印的消息
        echo "接收来自客户端{$frame->fd}的消息：{$frame->data}，opcode为：{$frame->opcode}，fin为：{$frame->finish}，时间为：".date('H:i:s', time())."\n";

        $data = [
            'task' => 1,
            'fd' => $frame->fd
        ];
//        $ws->task($data);

        swoole_timer_after(5000, function() use ($ws, $frame) {
            echo "监听事件，延后5s：客户端ID：{$frame->fd}，时间为：".date('H:i:s', time())."\n";
            $ws->push($frame->fd, "定时器5秒后，监听到消息事件，消息内容是: {$frame->data}，时间为：".date('H:i:s', time())."\n");
        });

        //推送到客户端的消息
        $ws->push($frame->fd, "监听到消息事件，消息内容是: {$frame->data}，时间为：".date('H:i:s', time())."\n");
    }

    /**
     * 监听ws关闭事件
     * @param $ws
     * @param $fd
     */
    public function onClose($ws, $fd)
    {
        echo "客户端ID-{$fd}被关闭\n";
    }
}

$obj = new Ws();