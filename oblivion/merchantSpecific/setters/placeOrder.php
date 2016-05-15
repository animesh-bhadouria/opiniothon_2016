<?php
 require_once '../../helpers/db_connection.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $data = json_decode(file_get_contents("php://input"));
  print_r($data);
}


//testing with sample
// $test_json = '{"delivery_id":"ee76910050b7","merchant_id":"2211","customer_id":"12","time_created":"2016-05-15 00:30:48"}';
// $test_data = json_decode($test_json);



// echo "New request received from merchant_id : " . $data -> {'merchant_id'} . "\n";
// echo "Begin to insert the Delivery id : " . $data -> {'delivery_id'} . "\n";


 $result = setNewDelivery( 		$data ->{'delivery_id'} ,
 								$data ->{'merchant_id'} , 
 								$data ->{'customer_id'} ,
								"confirmed",
								$data ->{'time_created'}
							);


 echo $result;
 
// echo "Fetch delivery status from Database";

$response = getDeliveryDetails($data ->{'delivery_id'});

echo "<pre>";

print_r($response);

echo "</pre>";