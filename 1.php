<?php

$url = 'https://lastpass.com/enterpriseapi.php';

$post = [
    "cid" 		=> 123,
    "provhash" 	=> "somehash",
    "cmd" 		=> "getsfdata",
    "data" 		=> "all"
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec($ch);

curl_close ($ch);

$server_output_arr = json_decode($server_output);
$onlyusers = array();
$onlyusers_mixed = array();

foreach ($server_output_arr as $k1 => $v1) {
	foreach ($v1 as $k2 => $v2) {
		if ( is_array($v2)) {
			foreach ($v2 as $k3 => $v3) {
				if ( isset($v3->username) ) {
					$onlyusers_mixed[] = $v3->username;
				}
			}
		}
	}
}
$onlyusers = array_unique($onlyusers_mixed, SORT_STRING);
$onlyusers = array_values($onlyusers);
// var_dump($server_output);
// var_dump($server_output_arr);
var_dump($onlyusers);


?>