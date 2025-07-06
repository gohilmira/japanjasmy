<?php

$url = "https://test.eracom.in/bsc-pay-main/";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = [
  "Content-Type: application/x-www-form-urlencoded"
];

curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

/*$data = http_build_query([
  "api_key" => "61df57dd96f5d3310b1c77fd882b5e51c1dd9a57",
  "action" => "transfer",
  "to_address" => "0xEAC3ce292F95d779732e7a26c95c57A742cf5119",
  "token" => "tBUSD",
  "payment_amount" => "95"
]);*/

$data = http_build_query([
  "api_key" => "61df57dd96f5d3310b1c77fd882b5e51c1dd9a57",
  "action" => "test",
  "address" => "0x50966810A133cDf7083BDE254954A8D61041d09B",
  "token" => "tBUSD",
  "payment_amount" => "95"
]);

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

$result = json_decode(curl_exec($curl), true);
curl_close($curl);
var_dump($result);
?>