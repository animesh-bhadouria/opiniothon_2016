<?php
//Validate request             
if (empty($_POST['delivery_id']) || 
	empty($_POST['status'])) {
    	$result = array(
			'merchant_id' 	=> '',
			'delivery_id' 	=> '',
			'acknowledged'	=> 'false',
			);
} else {
	$delivery_id = $_POST['delivery_id'];
	$status = $_POST['status'];
	$expected_by = $_POST['expected_by'];
	echo "$delivery_id status is $staus ";
	$result = array(
			'merchant_id' 	=> '123',
			'delivery_id' 	=> $delivery_id,
			'acknowledged'	=> 'true',
			);
}
return json_encode($result);
