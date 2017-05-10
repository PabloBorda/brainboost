<?php 



function insertOrderToElasticSearch($order){

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://avnadmin:hkqa8xkbvjmt5c13@brainboost.brainboost-b168.aivencloud.com:17947/bbweb/order/3?pretty");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$toInsert = "{ \"body\": ".json_encode($order)."}";

echo $toInsert;  
curl_setopt($ch, CURLOPT_POSTFIELDS, $toInsert);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_CAINFO,'cacert.pem');

$headers = array();
$headers[] = "Content-Type: application/json";
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);
return $result;
}

$a = (object)array("name" => "John", "hobby" => "hiking", "culo" => "teta");

echo insertOrderToElasticSearch($a);




?>