<?php
//Validate request             
if (empty($_POST['info_type']) || 
	"classified" != $_POST['info_type']) {
    	$result = array(
			'merchant_id' 	=> '',
			'acknowledged'	=> 'false',
			);
} else {
	$info = $_POST['_internal'];
	$result = array(
			'merchant_id' 	=> '123',
			'acknowledged'	=> 'true',
			);
}
return json_encode($result);
