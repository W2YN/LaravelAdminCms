<?php
namespace App\Jobs\HuoBi;
class HuoBi{
	/**
	 * 获取火币的kline
	 * @param string $Btype btc ltc
	 * @param string $period	001  1分钟线 005 5分钟
	 * @return json
	 */
	static public function HuoBi_klineDataApi($Btype , $period)
	{
		$method_name = '获取火币的kline数据';
		$res = self::httpRequest('http://api.huobi.com/staticmarket/'.$Btype.'_kline_'.$period.'_json.js', '');
		return json_decode($res, true);
	}

	static protected function httpRequest($pUrl, $pData)
	{
		$tCh = curl_init();
		if ($pData) {
			is_array($pData) && $pData = http_build_query($pData);
			curl_setopt($tCh, CURLOPT_POST, true);
			curl_setopt($tCh, CURLOPT_POSTFIELDS, $pData);
		}
		curl_setopt($tCh, CURLOPT_HTTPHEADER, array("Content-type: application/x-www-form-urlencoded;charset=UTF-8"));
		curl_setopt($tCh, CURLOPT_URL, $pUrl);
		curl_setopt($tCh, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($tCh, CURLOPT_SSL_VERIFYPEER, false);
		$tResult = curl_exec($tCh);
		curl_close($tCh);
		return $tResult;
	}
}