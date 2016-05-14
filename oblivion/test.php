<?php
 require_once 'helpers/db_connection.php';



	$result = getMerchantDetails('1');

	echo "<pre>" . print_r($result,true) . "</pre>";
	
echo "hi";


?>