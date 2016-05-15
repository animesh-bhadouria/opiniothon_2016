<?php
 require_once '../../helpers/db_connection.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $data = json_decode(file_get_contents("php://input"));
  print_r($data);
}

$delivery_id = $data -> {'delivery_id'};

 $result = getDeliveryDetails($delivery_id);

echo "<pre>";

print_r($result);

echo "</pre>";

// "delivery_id":"ee769100506340b7aa39f9f5a0c63d0b",
// "merchant_id":"2211",
// "customer_id":"12",
// "time_created":"2016-05-15 00:30:48",
// "status":"pending||assigned||enroute||delivered||cancelled",
// "minion_id":"212",
// "expected_by":"2016-05-15 11:22:00"
