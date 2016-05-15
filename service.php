<?php

$currentLoc = dirname(__FILE__);
define('APPPATH', "$currentLoc/../");
require(APPPATH . 'common/helpers/networkHelper.php');

function placeOrder($delivery_id, $customer_id) {
	$postData = array(
		'delivery_id'	=> $delivery_id,
		'merchant_id'	=> '2211',
		'customer_id'	=> $customer_id,
		'time_created'	=> Date('Y-m-d H:i:s'),
	);

	$url = '<obvilion_url>/placeOrder';
	NetworkHelper::postit($url, $postData);
}

function trackOrder($delivery_id, $customer_id) {
	$postData = array(
		'delivery_id'	=> $delivery_id,
		'merchant_id'	=> '2211',
		'customer_id'	=> $customer_id,
		'time_created'	=> Date('Y-m-d H:i:s'),
	);

	$url = '<obvilion_url>/placeOrder';
	NetworkHelper::postit($url, $postData);
}

function cancelOrder($delivery_id, $customer_id) {
	$postData = array(
		'delivery_id'	=> $delivery_id,
		'merchant_id'	=> '2211',
		'customer_id'	=> $customer_id,
		'time_created'	=> Date('Y-m-d H:i:s'),
	);

	$url = '<obvilion_url>/placeOrder';
	NetworkHelper::postit($url, $postData);
}

function updateOrder($delivery_id, $customer_id) {
	$postData = array(
		'delivery_id'	=> $delivery_id,
		'merchant_id'	=> '2211',
		'customer_id'	=> $customer_id,
		'time_created'	=> Date('Y-m-d H:i:s'),
	);

	$url = '<obvilion_url>/placeOrder';
	NetworkHelper::postit($url, $postData);
}
