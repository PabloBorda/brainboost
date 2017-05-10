<?php
require '../../vendor/autoload.php';

use Elasticsearch\ClientBuilder;

$params = array();

$params['connectionClass'] = '\Elasticsearch\Connections\CurlMultiConnection';

$params['hosts'] = array (
    'https://avnadmin:hkqa8xkbvjmt5c13@brainboost.brainboost-b168.aivencloud.com:17947'
);

$params['connectionParams']['curlOpts'] = array(
    CURLOPT_SSL_VERIFYPEER => true,
    CURLOPT_SSL_VERIFYHOST => 2,
    CURLOPT_CAINFO => 'cacert.pem',
    CURLOPT_SSLCERTTYPE => 'PEM',
    CURLOPT_HTTPHEADER => [ 'Content-Type: application/json' ]
);

$singleHandler  = ClientBuilder::singleHandler();
$multiHandler   = ClientBuilder::multiHandler();

$client = ClientBuilder::create()
                    ->setHosts($params['hosts'])
                    ->setSSLVerification('cacert.pem')
                    ->setHandler($singleHandler)
                    ->build();




try {
  
    $client->search([]);
  
} catch (Elasticsearch\Common\Exceptions\Curl\CouldNotConnectToHost $e) {
    $previous = $e->getPrevious();
    echo "cannot connect";
}

$params = [  
  'index' => [
    '_index' => 'bbweb',
    '_type' => 'order',
    '_id' => '1'],
  'body' => [
        'test' => 'hello wordl!'
    ]  
];


echo $client->bulk($params);




?>
