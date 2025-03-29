<?php

/**
 * @param $href
 *
 * @return bool|string
 */
function get_data($href){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_HEADER, FALSE);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($curl, CURLOPT_URL, $href);
    curl_setopt($curl, CURLOPT_REFERER, $href);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_USERAGENT,
        "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/533.4 (KHTML, like Gecko) Chrome/5.0.375.125 Safari/533.4");
    $str = curl_exec($curl);
    curl_close($curl);

    return $str;
}


function api_get_post_by_webgia(){
    $url = 'https://webgia.com/gia-hang-hoa/ca-phe/';

    return get_data($url);
}
function api_get_post_by_webgiaGiaCaPheTheGioi(){
    $url = 'https://webgia.com/gia-hang-hoa/ca-phe-the-gioi/';

    return get_data($url);
}