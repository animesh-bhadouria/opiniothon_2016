<?php
//Validate request             
if (empty($_POST['delivery_id']) || 
	empty($_POST['merchant_id']) ||
	empty($_POST['customer_id'])) {
    	$result = array(
			'minion_id' 		=> '',
			'delivery_id' 		=> '',
			'acceptance_state'	=> 'rejected',
			);
} else {
	$delivery_id = $_POST['delivery_id'];
	$merchant_id = $_POST['merchant_id'];
	$customer_id = $_POST['customer_id'];
	$result = array(
			'minion_id' 		=> '123',
			'delivery_id' 		=> $delivery_id,
			'acceptance_state'	=> '',
			);

	if (deliveryFeasible($customer_id)) {
		$result['acceptance_state']	= 'accepted';
		updateInfo();
		updateDeliveryInfo($delivery_id, $merchant_id, $customer_id);
	} else {
		$result['acceptance_state'] = 'rejected';
	}
}
return json_encode($result);

//Decides whether delivery to $customer_id is possible
function deliveryFeasible($customer_id) {
	//Can't deliver if the agent is not free
	$loc = dirname(__FILE__);
	$fl = "$loc/min.info";
	$handle = fopen($fl, 'r');
	$data = fread($handle,filesize($fl));
	$info = json_decode($data);
	if('free' != $info -> minion_status) {
		return false;
	}
	return true;
}

function updateInfo() {
	$data = array(
		'minion_id' 	=> '212',
		'minion_status' => 'busy',
		'minion_phno' 	=> '9840401776',
		'minion_lat' 	=> '12.9716',
		'minion_long' 	=> '77.5946',
	);
	$loc = dirname(__FILE__); 
	$info = "$loc/min.info";
	$handle = fopen($info, 'w');
	fwrite($handle,json_encode($data));
}

function updateDeliveryInfo($delivery_id, $merchant_id, $customer_id) {
	$data = array(
		'minion_id' 	=> '212',
		'delivery_id'	=> $delivery_id,
		'merchant_id'	=> $merchant_id,
		'customer_id'	=> $customer_id,
		'job_start_time'=> time(),
	);
	$loc = dirname(__FILE__); 
	$info = "$loc/delivery.info";
	$handle = fopen($info, 'w');
	fwrite($handle,json_encode($data));
}
