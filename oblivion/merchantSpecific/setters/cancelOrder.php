<?php

 require_once '../../helpers/db_connection.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $data = json_decode(file_get_contents("php://input"));
  print_r($data);
}

$result = setNewDelivery( 		$data ->{'delivery_id'} ,
 								$data ->{'merchant_id'} , 
 								$data ->{'customer_id'} ,
								"cancelled",
								$data ->{'time_created'}
							);


 echo $result;
 
// echo "Fetch delivery status from Database";

$response = getDeliveryDetails($data ->{'delivery_id'});

echo "<pre>";

print_r($response);

echo "</pre>";


?>