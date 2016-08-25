<?php

namespace App\Jobs\BTCC;

class BTCC{

	const WEB_BASE = 'https://pro-data.btcc.com/';//BTCC 中国站
	const API_BASE = 'data/pro/';

	/**
	 * 获取 BTCC 的kline
	 * @param string $symbol
	 * @param int $limit
	 * @param int $since
	 * @param string $sincetype
	 * 默认返回前一百条
	 *
	 * @return json
	 */
	static public function klineDataApi( $symbol =  'XBTCNY', $limit = 100 , $since = 0, $sincetype = 'id' )
	{
		$url = self::WEB_BASE . self::API_BASE.'historydata';
		$params = [];
		!empty($since) && $params['since'] =  $since;
		!empty($limit) && $params['limit'] =  $limit;
		!empty($symbol) && $params['symbol'] =  $symbol;
		!empty($sincetype) && $params['sincetype'] =  $sincetype;
		if(!empty($params)){
			$url = $url.'?'.http_build_query($params);
		}
		$res = httpRequest( $url );
		return json_decode($res, true);
	}

	/**
	 *
	 * 获取 BTCC 实时交易数据
	 * @param string $symbol
	 * @param int $limit
	 * @return array
	 *
	 */
	static public function NowDataApi( $symbol =  'XBTCNY', $limit = 100 )
	{

		$url = self::WEB_BASE.self::API_BASE.'ticker';
		$params = [];
		!empty($since) && $params['since'] =  $since;
		!empty($limit) && $params['limit'] =  $limit;
		!empty($symbol) && $params['symbol'] =  $symbol;
		!empty($sincetype) && $params['sincetype'] =  $sincetype;
		if(!empty($params)){
			$url = $url.'?'.http_build_query($params);
		}
		$res = httpRequest( $url );
		return json_decode($res, true);
	}
}