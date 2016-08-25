<?php
if ( ! function_exists('httpRequest')) {

    /**
     *
     * 发送curl请求
     *
     */
    function httpRequest( $pUrl , $pData = '')
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
