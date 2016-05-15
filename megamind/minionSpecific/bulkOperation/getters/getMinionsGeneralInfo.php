<?php

$rooturl = dirname( __FILE__,5);


require_once $rooturl . '/common/helpers/fileHelper.php';

$jsonurl = $rooturl .  "/minion/min.info";



$data = '{"minion_id":"212","minion_status":"busy","minion_phno":"9840401776","minion_lat":"12.9815","minion_long":"77.5957"}';
// 
// 
// Get the $data from csv.
// 
// 
// 

$success = FileHelper::readFile($jsonurl,$data);

echo $success;






?>