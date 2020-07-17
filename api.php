<?php

if(@$_GET['id']||@$_GET['shortcode']||@$_GET['useragent']||@$_GET['cookie']||@$_GET['proxy']||@$_GET['proxyuser']){

    print like($_GET['id'],$_GET['shortcode'],$_GET['useragent'],$_GET['cookie'],$_GET['proxy'],$_GET['proxyuser']);

}

function curl($url, $data=null, $useragent=null, $cookie=null, $proxy =0, $userpwd = 0) {

    

//The IP address of the proxy you want to send

    //your request through.

     $proxy = $_GET['proxy'];

  //The username for authenticating with the proxy.

     $userpwd = $_GET['proxyuser'];

     

    $c = curl_init();

    curl_setopt($c, CURLOPT_URL, $url);

    if($data != null){

        curl_setopt($c, CURLOPT_POST, true);

        curl_setopt($c, CURLOPT_POSTFIELDS, $data);

    }

    curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);

    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);

    curl_setopt($instagram, CURLOPT_HTTPPROXYTUNNEL , 1);

    if($cookie != null){

        curl_setopt($c, CURLOPT_COOKIE, $cookie);

    }

    if($useragent != null){

        curl_setopt($c, CURLOPT_USERAGENT, $useragent);

    }

    if ($proxy)

        curl_setopt($instagram, CURLOPT_PROXY, $proxy);

    if ($userpwd):

        curl_setopt($instagram, CURLOPT_PROXYUSERPWD, $userpwd);

        endif;

    $hmm = curl_exec($c);

    curl_close($c);

    return $hmm;

}

function like($id, $code, $useragent, $cookie , $proxy =0, $userpwd = 0) {

    

//The IP address of the proxy you want to send

    //your request through.

     $proxy = $_GET['proxy'];

  //The username for authenticating with the proxy.

     $userpwd = $_GET['proxyuser'];

     

    $instagram = curl_init();

    curl_setopt($instagram, CURLOPT_URL, "https://www.instagram.com/web/likes/".$id."/like/");

    curl_setopt($instagram, CURLOPT_SSL_VERIFYPEER, false);

    curl_setopt($instagram, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($instagram, CURLOPT_FOLLOWLOCATION, 1);

    curl_setopt($instagram, CURLOPT_HTTPPROXYTUNNEL , 1);

    if ($proxy)

        curl_setopt($instagram, CURLOPT_PROXY, $proxy);

    if ($userpwd):

        curl_setopt($instagram, CURLOPT_PROXYUSERPWD, $userpwd);

        endif;

    $data = curl('https://www.instagram.com/p/'.$code, 0, $useragent, $cookie, $proxy, $userpwd);

    $csrf_token = preg_match('/"csrf_token":"(.*?)",/', $data, $csrf_token) ? $csrf_token[1] : null;

    $rolout = preg_match('/"rollout_hash":"(.*?)",/', $data, $rolout) ? $rolout[1] : null;

    curl_setopt($instagram, CURLOPT_HTTPHEADER, array(

        'Host: www.instagram.com',

        'Accept: */*',

        'Accept-Language: en-US,en;q=0.5',

        'Referer: https://www.instagram.com/p/'.$code.'/',

        'X-CSRFToken: '.$csrf_token,

        'X-Instagram-AJAX: '.$rolout,

        'Content-Type: application/x-www-form-urlencoded',

        'X-Requested-With: XMLHttpRequest',

        'Connection: keep-alive'

    ));

    curl_setopt($instagram, CURLOPT_POSTFIELDS, '');

    curl_setopt($instagram, CURLOPT_HEADER, 0);

    curl_setopt($instagram, CURLOPT_COOKIE, $cookie);

    curl_setopt($instagram, CURLOPT_USERAGENT, $useragent);

    $response = curl_exec($instagram);

    return $response;

}

echo '{"userallow":"ok"}','{"minimum":"10"}'; 

