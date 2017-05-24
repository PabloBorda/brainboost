<?php 


    function insertOrderToElasticSearch($order){
				//file_put_contents(dirname(__FILE__)."/classes/testing.txt","TESTING\n",FILE_APPEND);  
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://avnadmin:hkqa8xkbvjmt5c13@brainboost.brainboost-b168.aivencloud.com:17947/bbweb/order/?pretty");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  
        $toInsert = "{ \"body\": ".$order."}";

        //file_put_contents(dirname(__FILE__)."/classes/testing.txt","FROM COMMAND: ".$toInsert."\n",FILE_APPEND);  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $toInsert);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_CAINFO,dirname(__FILE__).'/cacert.pem');

        $headers = array();
        $headers[] = "Content-Type: application/json";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            file_put_contents(dirname(__FILE__)."/classes/testing.txt","(Error:".curl_error($ch)."\n",FILE_APPEND);
        }
				//file_put_contents(dirname(__FILE__)."/classes/testing.txt","GOOD!: ".$result."\n",FILE_APPEND);
        curl_close ($ch);
        return $result;
							
  }

  insertOrderToElasticSearch($argv[1]);




?>