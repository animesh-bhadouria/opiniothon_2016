<?php 
require_once 'db_properties.php';


function connectDatabase()
{
	if (($mysql_connection = mysqli_connect(mysql_HOST, mysql_USER, mysql_PASSWORD, mysql_DATABASE)) === false)
	{
		 die("Error cannot connect to database." . mysqli_error($mysql_connection));
	}	
	return $mysql_connection;
}

function disconnectDatabase($mysql_connection)
{
	mysqli_close($mysql_connection);
}


function convertQueryResultToJSON($result_set)
{
	$tmparray = array();

    while($row = mysqli_fetch_assoc($result_set))
    {
        $tmparray[] = $row;
    }
    return json_encode($tmparray,JSON_PRETTY_PRINT);
}

function insertQueryToDB($sql_query)
{
	$mysql_connection = connectDatabase();

	if (mysqli_query($mysql_connection, $sql_query)) 
	{
	    echo "New record created successfully";
	} else 
	{
	    echo "Error: " . $sql_query . "<br>" . mysqli_error($mysql_connection);
	}

	disconnectDatabase($mysql_connection);

	return true;
}



// ########################################################################################################################################## //



function getMerchantDetails($merchant_id)
{
	$mysql_connection = connectDatabase();

	$sql = "SELECT  merchant_id,merchant_name,merchant_phno,merchant_addr,merchant_lat,merchant_long,merchant_priority,merchant_rating 
			FROM merchants WHERE merchant_id =  '$merchant_id' ";

	$result = mysqli_query($mysql_connection, $sql) or die("Error in Selecting " . mysqli_error($mysql_connection));
	
	
	disconnectDatabase($mysql_connection);

	return convertQueryResultToJSON($result);
}




function setMerchantDetails(	$merchant_name,
								$merchant_phno,
								$merchant_addr,
								$merchant_lat,
								$merchant_long,
								$merchant_priority,
								$merchant_rating,
								$date
							)
{
	
	$sql = "INSERT INTO merchants (merchant_name,merchant_phno,merchant_addr,merchant_lat,merchant_long,merchant_priority,merchant_rating,date_registered) VALUES
       ('$merchant_name','$merchant_phno','$merchant_addr','$merchant_lat','$merchant_long','$merchant_priority','$merchant_rating','$date')";

   
    return insertQueryToDB($sql);
}




// ########################################################################################################################################## //





function getCustomerDetails($customer_id)
{

	$mysql_connection = connectDatabase();

	$sql = "SELECT  customer_id,customer_name,customer_phno,customer_addr,customer_lat,customer_long,customer_rating 
			FROM customers WHERE customer_id =  '$customer_id' ";
	$result = mysqli_query($mysql_connection, $sql) or die("Error in Selecting " . mysqli_error($mysql_connection));
	
	
	disconnectDatabase($mysql_connection);

	return convertQueryResultToJSON($result);	

}

function setCustomerDetails(	$customer_name,
								$customer_phno,
								$customer_addr,
								$customer_lat,
								$customer_long,
								$customer_rating,
								$date
							)
{

	$sql = "INSERT INTO customers (customer_name,customer_phno,customer_addr,customer_lat,customer_long,customer_rating,date_registered) VALUES
       ('$customer_name','$customer_phno','$customer_addr','$customer_lat','$customer_long','$customer_rating','$date')";

    return insertQueryToDB($sql);

}






// ########################################################################################################################################## //



function getMinionDetails($minion_id)
{
	$mysql_connection = connectDatabase();

	$sql = "SELECT  minion_id,minion_status,minion_phno,minion_lat,minion_long,minion_priority,minion_rating 
			FROM minions WHERE minion_id =  '$minion_id' ";

	$result = mysqli_query($mysql_connection, $sql) or die("Error in Selecting " . mysqli_error($mysql_connection));
	
	
	// disconnectDatabase($mysql_connection);

	return convertQueryResultToJSON($result);


}

function setMinionDetails(	$minion_name,
							$minion_phno,
							$minion_addr,
							$minion_lat,
							$minion_long,
							$minion_priority,
							$minion_rating,
							$date
						)
{

	$sql = "INSERT INTO minions (minion_name,minion_phno,minion_addr,minion_lat,minion_long,minion_priority,minion_rating,date_registered) VALUES
       ('$minion_name','$minion_phno','$minion_addr','$minion_lat','$minion_long','$minion_priority','$minion_rating','$date')";

    return insertQueryToDB($sql);


}


function updateMinionLocation($minion_id	,	$minion_lat	,	$minion_long)
{
	
	$sql = "UPDATE minions SET minion_lat = '$minion_lat', minion_long = '$minion_long'
			WHERE minion_id = '$minion_id'";

    return insertQueryToDB($sql);
}



function updateMinionPriority($minion_id	,	$minion_priority)
{

	$sql = "UPDATE minions SET minion_priority = '$minion_priority' 
			WHERE minion_id = '$minion_id'";

    return insertQueryToDB($sql);
}


function updateMinionStatus($minion_id	,	$minion_status)
{

	$sql = "UPDATE minions SET minion_status = '$minion_status' 
			WHERE minion_id = '$minion_id'";

    return insertQueryToDB($sql);
}


function updateMinionRating($minion_id	,	$minion_rating)
{

	$sql = "UPDATE minions SET minion_rating = '$minion_rating'
			WHERE minion_id = '$minion_id'";

    return insertQueryToDB($sql);
}


// ########################################################################################################################################## //




function getDeliveryDetails($delivery_id)
{

	$mysql_connection = connectDatabase();

	$sql = "SELECT  delivery_id ,merchant_id ,customer_id, minion_id ,status ,time_created ,time_completed  ,time_updated 
			FROM deliveries WHERE delivery_id =  '$delivery_id'";
	$result = mysqli_query($mysql_connection, $sql) or die("Error in Selecting " . mysqli_error($mysql_connection));
	
	
	disconnectDatabase($mysql_connection);

	return convertQueryResultToJSON($result);	

}

function updateDeliveryDetails($delivery_id,$merchant_id,$customer_id,$status,$time_updated)
{
	$sql = "UPDATE deliveries SET status = '$status' , merchant_id = '$merchant_id' , customer_id = '$customer_id' , time_updated = '$time_updated'
			WHERE delivery_id = '$delivery_id'";

    return insertQueryToDB($sql);
}


function setNewDelivery		(	$delivery_id,
								$merchant_id,
								$customer_id,
								$status,
								$time_created
							)
{

	$sql = "INSERT INTO deliveries (delivery_id,merchant_id,customer_id,status,time_created) VALUES
       ('$delivery_id','$merchant_id','$customer_id','$status','$time_created')";

    return insertQueryToDB($sql);

}


function updateDeliveryMinionDetails($delivery_id,$minion_id,$status,$time_updated)
{
	$sql = "UPDATE deliveries SET minion_id = '$minion_id' ,  status = '$status' ,  time_updated = '$time_updated' 
			WHERE delivery_id = '$delivery_id'";

    return insertQueryToDB($sql);
}


function updateDeliveryStatusDetails($delivery_id,$status,$time_completed,$time_updated)
{
	$sql = "UPDATE deliveries SET status = '$status' , time_completed = '$time_completed' , time_updated = '$time_updated'
			WHERE delivery_id = '$delivery_id'";

    return insertQueryToDB($sql);
}





?>