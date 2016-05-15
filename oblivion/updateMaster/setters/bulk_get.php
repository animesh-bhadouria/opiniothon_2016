<?php
 require_once '../../helpers/db_connection.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $data = json_decode(file_get_contents("php://input"));
  print_r($data);
}

// $test_json = '[{"delivery_id":"ee76910063d0b"},{"delivery_id":"aljc63d0b"}]';

// echo "<pre>";

// print_r($data);

// echo "</pre>";


// $test_data = json_decode($data);

// echo "<pre>";

// print_r($test_data);

// echo "</pre>";

// echo count($test_data);

$result = array();


for($i = 0;$i < count($data) ; $i++)
{
	$result[i] = getDeliveryDetails($data[i]->{'delivery_id'});
}

$response = json_encode($result);

 echo "<pre>";

 print_r($response);

 echo "</pre>";




//  [
// {
// "delivery_id":"ee769100506340b7aa39f9f5a0c63d0b",
// "merchant_id":"2211",
// "customer_id":"12",
// "time_created":"2016-05-15 00:30:48",
//               "status":"pending||assigned||enroute||delivered||cancelled",
//               "minion_id":"212",
//               "expected_by":"2016-05-15 11:22:00"

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


?>