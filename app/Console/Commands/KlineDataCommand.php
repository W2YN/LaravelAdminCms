<?php

namespace App\Console\Commands;

use App\Jobs\BTCC\BTCC;
use App\Jobs\BtcTrade\BtcTrade;
use App\Jobs\HuoBi\HuoBi;
use App\Jobs\Poloniex\Poloniex;
use Illuminate\Console\Command;

class KlineDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'BData:Kline 
                            {platformName : 平台的名称} 
                            {symbol : 获取哪种B} 
                            ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'In order to obtain the kline data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        // 获取参数
        $platformName  = $this->argument('platformName');
        $symbol        = $this->argument('symbol');
//        $type       = $this->argument('type');
        $type          = '1min';
        $result = [];
        // 根据平台名称调用不同的接口
        switch ( $platformName ){
            // 获取OKCoin Kline行情
            case 'OkCoin':
                // 获取一个用户的apiKey
                $secretKey 	= '3DFC88442E5AE46D5A69527C35417986';
                $apiKey 	= 'd97085b4-f727-480b-b0fc-2fe7cd5a252f';
                $client = new \OKCoin(new \OKCoin_ApiKeyAuthentication( $apiKey , $secretKey));
                $params = [
                    'symbol' => $symbol ,
                    'type'   => $type ,
                    'size'   => 60 ,
                ];
                $result = $client -> klineDataApi( $params );
                // 返回结果存储到redis中
                foreach ($result as &$v){
                    $v[0] = date('Y-m-d H:i:s', $v[0]/1000);
                }
                break;
            // 获取 HuoBi Kline行情
            case 'HuoBi':
                // 获取一个用户的apiKey
                $accessKey 	= '0115a765-4d10b14b-3c8c5422-aa408';
                $secretKey 	= 'd17c8151-cb5bb8df-7bea865c-c5f82';
                // 每次三百条
                $result = HuoBi::HuoBi_klineDataApi( $symbol , '001' );
                break;
            // 获取 比特币交易网 Kline行情
            case 'BtcTrade':
                $result = BtcTrade::klineDataApi();
                break;
            // 获取 BTCC Kline行情
            case 'BTCC':
                $result = BTCC::klineDataApi();
                break;
            // 获取 BTCC Kline行情
            case 'Poloniex':
                $poloniex =  new Poloniex('','');
                $result = $poloniex->get_trade_history('BTC_NXT');
                break;
        }
        // 存储到redis
        print_r($result);

    }
}
