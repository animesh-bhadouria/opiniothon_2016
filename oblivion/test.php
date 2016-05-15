<?php
 require_once 'helpers/db_connection.php';



$test_json = '{"delivery_id":"ee76910050b7","merchant_id":"1","customer_id":"12","time_created":"2016-05-15 00:30:48"}';

$test_data = json_decode($test_json);


$delivery_id = $test_data ->{'delivery_id'} ;
$merchant_id = $test_data ->{'merchant_id'} ;
$customer_id = $test_data ->{'customer_id'} ;
$minion_id = 'null';
$status = "Order Placed";
$time_created = $test_data ->{'time_created'};
$time_completed = 'null';
$time_updated = 'null';


 // 	$mysql_connection = connectDatabase();


 // 	$sql_query = "INSERT INTO deliveries (	delivery_id,
	// 									 	merchant_id,
	// 									 	customer_id,
	// 									 	status,
	// 									 	time_created
	// 									 ) 
 // 	VALUES
 //       (	   '$delivery_id',
	// 	       '$merchant_id',
	// 	       '$customer_id',
	// 	       '$status',
	// 	       '$time_created'
	// 	)";


	// if (mysqli_query($mysql_connection, $sql_query)) 
	// {
	//     echo "New record created successfully";
	// } else 
	// {
	//     echo "Error: " . $sql_query . "<br>" . mysqli_error($mysql_connection);
	// }

	// disconnectDatabase($mysql_connection);

	echo	setNewDelivery		(	$delivery_id,
								$merchant_id,
								$customer_id,
								$status,
								$time_created
							);
 

?>