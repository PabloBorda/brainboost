<?php
  require 'ElasticSearch.php';

  $el = new ElasticSearch();
  $data = [
    'index' => 'bb_prestashop',
    'type' => 'order',
   
    'body' => [
        'script' => 'c54555crfrefrrf55455455 += count',
        'params' => [
            'count44' => 353
        ],
        'upsert1' => [
            'counter44' => 531
        ]
    ]
];
  $resp = $el->addElasticOrder("HIUH&£HH*H",$data,["index" => "bb_prestashop","type" => "order"]);

  
  var_dump($resp);

?>
