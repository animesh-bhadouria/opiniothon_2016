<?php
require_once '../../helpers/db_connection.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $data = json_decode(file_get_contents("php://input"));
  print_r($data);
}

// dummy REQUEST
// "minion_id":"2211",
// "minion_status":"busy",
// "minion_phno":"9840401776",
// "minion_lat":"12.9716",
// "minion_long":"77.5946"


$minion_id = $data -> {'minion_id'};
$minion_status = $data -> {'minion_status'};
$minion_phno = $data -> {'minion_phno'};
$minion_lat = $data -> {'minion_lat'};
$minion_long = $data -> {'minion_long'};



$minion_details = getMinionDetails($minion_id);
$minion_details_array = json_parse($minion_details,true);

$minion_priority = $minion_details_array -> {'minion_priority'};

updateMinionLocation($minion_id	,	$minion_lat	,	$minion_long);
updateMinionPriority($minion_id	,	$minion_priority+1);
updateMinionStatus($minion_id	,	$minion_status);


$response_array = array("minion_id" => $minion_id,"request_acknowledged" => "true" );

$responseJSON = json_encode($response_array);

echo "<pre>";
print_r($responseJSON);
echo "</pre>";


//dummy response
// "minion_id":"212",
// "request_acknowledged":"true||false”




?>