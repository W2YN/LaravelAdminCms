<?php

namespace App\Http\Controllers\Spider;

use App\Facades\ActionRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Form\ActionCreateForm;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Workerman\Connection\AsyncTcpConnection;
use Workerman\Worker;


class OkCoinController 
{
    /**
     * Store a newly created resource in storage.
     * 接收okCoin的数据推送
     * @return \Illuminate\Http\Response
     */
    public function WebSocketOkSubSpotcnyXTicker()
    {
        $worker = new Worker();
        // 进程启动时
        $worker->onWorkerStart = function()
        {
            // 以websocket协议连接远程websocket服务器
            $ws_connection = new AsyncTcpConnection("wss://real.okcoin.cn:10440/websocket/okcoinapi");
            // 连上后发送hello字符串
            $ws_connection->onConnect = function($connection){
                $sendData = [
                    [
                        'event'     => 'addChannel',
                        'channel'   => 'ok_sub_spotcny_btc_ticker'
                    ],[
                        'event'     => 'addChannel',
                        'channel'   => 'ok_sub_spotcny_btc_depth_Y'
                    ]

                ];
                $sendData = json_encode($sendData);
                $connection->send($sendData);
            };
            // 远程websocket服务器发来消息时
            $ws_connection->onMessage = function($connection, $data){
                echo "recv: $data\n";
            };
            // 连接上发生错误时，一般是连接远程websocket服务器失败错误
            $ws_connection->onError = function($connection, $code, $msg){
                echo "error: $msg\n";
            };
            // 当连接远程websocket服务器的连接断开时
            $ws_connection->onClose = function($connection){
                echo "connection closed\n";
            };
            // 设置好以上各种回调后，执行连接操作
            $ws_connection->connect();
        };
        Worker::runAll();

    }

}
