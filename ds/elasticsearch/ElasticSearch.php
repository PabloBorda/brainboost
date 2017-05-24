<?php
require dirname(__FILE__).'/../../vendor/autoload.php';	//autoload.php from elastic-search
class ElasticSearch
{
private $_client;
	 
	public function __construct(){
		if ($this->_client === NULL)
			$this->connect();
		return $this->_client;
	} 
	 
	 /**
	 * Initialize Elastic Search Object 
	 */
	public function connect()
	{
		$params = array();
		$hosts=[
    'https://avnadmin:hkqa8xkbvjmt5c13@brainboost.brainboost-b168.aivencloud.com:17947'  // SSL to IP + Port
];
   
		
		$clientBuilder = Elasticsearch\ClientBuilder::create();   // Instantiate a new ClientBuilder
    $clientBuilder->setHosts($hosts); 
		$clientBuilder->setSSLCert('cacert.pem');// Set the hosts
    $client = $clientBuilder->build();          // Build the client object
		
		
$this->_client = $client;
	}
	
	public function getInstance()
	{
		return $this->_client;
	}
	
	
/**
	 * Update already existing data in elastic search.
	 * We can update date for multiple ids.	
	 * Data format must be like as below
	 * $params will contain ‘inedx’ and ‘type’ parameter for data to be updated.
	 * $data=array(
		       _id1=>array(
				'field1'=>'value1',
				'field2'=>'value2',
			 	 ...
				),
			 _id2=> array(
				'field1'=>'value1',
				'field2'=>'value2',
			 	 ...
				),
			   ...	
			   );
	 * 	 _id => updateArray
	 */
	public function updateData($data,$params)
	{
	  try {
		if(!isset($params['index']) || !isset($params['type']))
			die("Unable to update Elastic. Either index or type is not defined");
		
		$client = $this->_client;
		
		foreach ($data as $_id => $update) 
		{
			$params['body'][] = array(
        		'update' => array(
            		'_id' => $_id
        		)
    		);
			
			$params['body'][] = array(
        		'doc_as_upsert' => 'true',
        		'doc' => $update
    		);
			
		}
		$responses = $client->bulk($params);
	  }
	  catch(exception $e)
	  {
			//die($e->getMessage());
	  }
	}
 
	
	/**
* Add data in elastic search
* $data format must be same as in previous function (i.e.  _id=insertArray)
       *  @param array() $data :- data to be inserted
	*  @param array() $params:- contains index and type information
	*  @return Add Provided data to Elastic search document for given Listing and type
	 */
	public function addElasticOrder($order_id, $data, $params)
	{
	  try{
		if(!isset($params['index']) || !isset($params['type']))
			die("Unable to update Elastic. Either index or type is not defined");
		
		$client = $this->_client;
		foreach ($data as $_id => $insert)
		{
    		$params['body'][] = array(
        		'index' => array(
            	'_id' => $order_id
        	)
    	  );
		  $params['body'][] = $insert;
		}
		$responses = $client->bulk($params);
		return $responses;
		}
	  catch(Exception $e){
			die($e->getMessage());
	  }
	}
	
	/**
	 * This function will delete all data for given Index and Type in Elastic search
	 */
	public function deleteElastic($params)
	{
	  if(!isset($params['index']) || !isset($params['type']))
		die("Unable to delete data. Either index or type is not defined");
	  try{
	  	$client = $this->_client;
		unset($params['type']);
		$client->indices()->delete($params);
  }
	  catch (Exception $e) {
			//die($e->getMessage());
	  }
	}	
}
?>
