<?php
 require_once '../../helpers/db_connection.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $data = json_decode(file_get_contents("php://input"));
  print_r($data);
}

// sample request
// "delivery_id":"ee769100506340b7aa39f9f5a0c63d0b",
// "merchant_id":"2211",
// "customer_id":"12",
// "time_created":"2016-05-15 00:30:48",
// "status":"pending||assigned||enroute||delivered||cancelled",
// "minion_id":"212",
// "expected_by":"2016-05-15 11:22:00"

$delivery_id = $data ->{'delivery_id'};
$merchant_id = $data ->{'merchant_id'};
$customer_id = $data ->{'customer_id'} ;
$status 	 = $data ->{'status'};
$minion_id 	 = $data ->{'minion_id'};
$expected_by = $data ->{'expected_by'};
$time_updated =  date("Y-m-d H:i:s");

$result 	= updateDeliveryDetails($delivery_id,$merchant_id,$customer_id,$status,$time_updated);
$result_2 	=  updateDeliveryMinionDetails($delivery_id,$minion_id,$status,$time_updated);



// echo "Fetch delivery status from Database";
$response_array = array("delivery_id" => $delivery_id,"updated" => "true" );
$responseJSON = json_encode($response_array);

echo "<pre>";
print_r($responseJSON);
echo "</pre>";




// sample response
// "delivery_id":"ee769100506340b7aa39f9f5a0c63d0b",
// "updated":"true||false"