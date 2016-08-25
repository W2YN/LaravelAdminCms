<?php

namespace App\Jobs\BtcTrade;

class BtcTrade{

	const WEB_BASE = 'http://api.btctrade.com/';//BTCC 中国站
	const API_BASE = 'api/';

	/**
	 * 获取 BtcTrade 的成交记录
	 * @param string $symbol	btc,eth,ltc,doge,ybc
	 * @param int $since
	 * @return array
	 */
	static public function klineDataApi( $symbol =  'btc' ,$since = 0 )
	{
		$url = self::WEB_BASE . self::API_BASE.'trades';
		$params = [];
		!empty($since) && $params['since'] =  $since;
		!empty($symbol) && $params['coin'] =  $symbol;
		if(!empty($params)){
			$url = $url.'?'.http_build_query($params);
		}
		$res = httpRequest( $url );
		return json_decode($res, true);
	}

	/**
	 *
	 * 获取 BtcTrade 实时交易数据
	 * @param string $symbol	btc,eth,ltc,doge,ybc
	 * @return array
	 *
	 */
	static public function NowDataApi( $symbol =  'btc' )
	{
		$url = self::WEB_BASE.self::API_BASE.'ticker';
		!empty($symbol) && $url = $url.'?'.http_build_query(['coin'=>$symbol]);
		$res = httpRequest( $url );
		return json_decode($res, true);
	}
}