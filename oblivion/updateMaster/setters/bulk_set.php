<?php
 require_once '../../helpers/db_connection.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $data = json_decode(file_get_contents("php://input"));
  print_r($data);
}


// [
// {
// "delivery_id":"ee769100506340b7aa39f9f5a0c63d0b",
// "merchant_id":"2211",
// "customer_id":"12",
// "time_created":"2016-05-15 00:30:48",
//               "status":"pending||assigned||enroute||delivered||cancelled",
//               "minion_id":"212",
//               "expected_by":"2016-05-15 01:22:00"

// },
// {
// "delivery_id":"aljarwo3506340b7aa39f9f5a0c63d0b",
// "merchant_id":"2505",
// "customer_id":"15",
// "time_created":"2016-05-15 00:40:48",
//               "status":"pending||assigned||enroute||delivered||cancelled",
//               "minion_id":"712",
//               "expected_by":"2016-05-15 01:22:00"

// }
// ]


$result = array();


for($i = 0;$i < count($data) ; $i++)
{

	$delivery_id = $data[i] ->{'delivery_id'};
	$merchant_id = $data[i] ->{'merchant_id'};
	$customer_id = $data[i] ->{'customer_id'} ;
	$status 	 = $data[i] ->{'status'};
	$minion_id 	 = $data[i] ->{'minion_id'};
	$expected_by = $data[i] ->{'expected_by'};
	$time_updated =  date("Y-m-d H:i:s");

$result_boolean 	=  updateDeliveryDetails($delivery_id,$merchant_id,$customer_id,$status,$time_updated);
$result_boolean 	=  updateDeliveryMinionDetails($delivery_id,$minion_id,$status,$time_updated);


$result[i] = {"delivery_id": , "result_2": $result_boolean };

}

$response = json_encode($result);

 echo "<pre>";

 print_r($response);

 echo "</pre>";





// [
// {
// "delivery_id":"ee769100506340b7aa39f9f5a0c63d0b",
// "updated":"true||false"
// },
// {
// "delivery_id":"aljarwo3506340b7aa39f9f5a0c63d0b",
// "updated":"true||false"
// }
// ]





?>