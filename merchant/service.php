<?php
function placeOrder($delivery_id, $customer_id) {
	$postData = array(
		'delivery_id'	=> $delivery_id,
		'merchant_id'	=> '2211',
		'customer_id'	=> $customer_id,
		'time_created'	=> Date('Y-m-d H:i:s'),
	);

	$url = '<obvilion_url>/placeOrder';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FAILONERROR, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
	$httpResult = curl_exec($ch);
	$error = curl_error($ch);
	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	echo $httpCode;
}

function trackOrder($delivery_id, $customer_id) {
	$postData = array(
		'delivery_id'	=> $delivery_id,
		'merchant_id'	=> '2211',
		'customer_id'	=> $customer_id,
		'time_created'	=> Date('Y-m-d H:i:s'),
	);

	$url = '<obvilion_url>/placeOrder';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FAILONERROR, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
	$httpResult = curl_exec($ch);
	$error = curl_error($ch);
	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	echo $httpCode;
}

function cancelOrder($delivery_id, $customer_id) {
	$postData = array(
		'delivery_id'	=> $delivery_id,
		'merchant_id'	=> '2211',
		'customer_id'	=> $customer_id,
		'time_created'	=> Date('Y-m-d H:i:s'),
	);

	$url = '<obvilion_url>/placeOrder';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FAILONERROR, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
	$httpResult = curl_exec($ch);
	$error = curl_error($ch);
	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	echo $httpCode;
}

function updateOrder($delivery_id. $customer_id) {
	$postData = array(
		'delivery_id'	=> $delivery_id,
		'merchant_id'	=> '2211',
		'customer_id'	=> $customer_id,
		'time_created'	=> Date('Y-m-d H:i:s'),
	);

	$url = '<obvilion_url>/placeOrder';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FAILONERROR, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
	$httpResult = curl_exec($ch);
	$error = curl_error($ch);
	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	echo $httpCode;
}
