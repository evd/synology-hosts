<?php

define('LOGIN_FAIL', 4);
define('USER_IS_FREE', 5);
define('USER_IS_PREMIUM', 6);
define('DOWNLOAD_URL', 'downloadurl');
define('DOWNLOAD_FILENAME', 'filename');
define('DOWNLOAD_COUNT', 'count');
define('DOWNLOAD_STATION_USER_AGENT', "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/535 (KHTML, like Gecko) Chrome/14 Safari/535");
define('DOWNLOAD_COOKIE', 'cookiepath');
define('DOWNLOAD_USERNAME', 'username');
define('DOWNLOAD_PASSWORD', 'password');
define('DOWNLOAD_ENABLE', 'enable');

include "lostfilm.php";
$env = include 'env.php';

$host = new SynoFileHostingLostfilm($env['url'], $env['uid'], $env['usess'], []);
$url = $host->GetDownloadInfo();

if (!$url) {
    echo 'Failed' . PHP_EOL;
}


$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => $url[DOWNLOAD_URL],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_COOKIEFILE => $url[DOWNLOAD_COOKIE]
));
$response = curl_exec($curl);

//TODO Better check for torrent file
if (strlen($response) > 1000) {
    echo 'Success' . PHP_EOL;
} else {
    echo 'Failed' . PHP_EOL . $response . PHP_EOL;
}
