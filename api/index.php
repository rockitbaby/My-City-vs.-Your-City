<?php

$API_KEY = "d4d7ea415bd6d0e922b92405384e95a7";

if (!isset($_GET['method'])) {
	exit();
}

$url = 'http://ws.audioscrobbler.com/2.0/?';
foreach($_GET as $key => $value) {
	$url .= $key.'='.urlencode(strtolower($value)).'&';
}
$url .= "api_key=" . $API_KEY;

$hash = md5($url);

if (!file_exists($hash) || filemtime($hash) < time() - 1000 * 60 * 30) {
	$data = file_get_contents($url);
	file_put_contents($hash, $data);
}
header("Content-Type: text/xml; charset=utf-8;");
readfile($hash);