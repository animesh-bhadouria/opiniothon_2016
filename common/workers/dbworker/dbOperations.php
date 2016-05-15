<?php 

require_once './connection.php';

/* Class DbOperations which contains/abstracts methods to interact with mysql database.
 *
 */


class DbOperations
{

	public function convertQueryResultToJSON($result_set)
	{
		$tmparray = array();

	    while($row = mysqli_fetch_assoc($result_set))
	    {
	        $tmparray[] = $row;
	    }
	    return json_encode($tmparray,JSON_PRETTY_PRINT);
	}

	public function insertQueryToDB($sql_query)
	{
		$mysql_connection = DbConnectionHelper::connectDatabase();

		$retval = mysqli_query($mysql_connection, $sql_query);
		
		if(! $retval )
		{
		  die('Could not enter data: ' . mysql_error());
		}

		DbConnectionHelper::disconnectDatabase($mysql_connection);

		return true;
	}



	// ########################################################################################################################################## //



	public function getMerchantDetails($merchant_id)
	{
		$mysql_connection = DbConnectionHelper::connectDatabase();

		$sql = "SELECT  merchant_id,merchant_name,merchant_phno,merchant_addr,merchant_lat,merchant_long,merchant_priority,merchant_rating 
				FROM merchants WHERE merchant_id =  '$merchant_id' ";

		$result = mysqli_query($mysql_connection, $sql) or die("Error in Selecting " . mysqli_error($mysql_connection));
		
		
		DbConnectionHelper::disconnectDatabase($mysql_connection);

		return convertQueryResultToJSON($result);
	}




	public function setMerchantDetails($merchant_name,$merchant_phno,$merchant_addr,$merchant_lat,$merchant_long,$merchant_priority,$merchant_rating,$date)
	{
		
		$sql = "INSERT INTO merchants (merchant_name,merchant_phno,merchant_addr,merchant_lat,merchant_long,merchant_priority,merchant_rating,date_registered) VALUES
	       ('$merchant_name','$merchant_phno','$merchant_addr','$merchant_lat','$merchant_long','$merchant_priority','$merchant_rating','$date')";

	   
	    return insertQueryToDB($sql);
	}



	// ########################################################################################################################################## //





	public function getCustomerDetails($customer_id)
	{

		$mysql_connection = DbConnectionHelper::connectDatabase();

		$sql = "SELECT  customer_id,customer_name,customer_phno,customer_addr,customer_lat,customer_long,customer_rating 
				FROM customers WHERE customer_id =  '$customer_id' ";
		$result = mysqli_query($mysql_connection, $sql) or die("Error in Selecting " . mysqli_error($mysql_connection));
		
		
		DbConnectionHelper::disconnectDatabase($mysql_connection);

		return convertQueryResultToJSON($result);	

	}

	public function setCustomerDetails($customer_name,$customer_phno,$customer_addr,$customer_lat,$customer_long,$customer_rating,$date)
	{

		$sql = "INSERT INTO customers (customer_name,customer_phno,customer_addr,customer_lat,customer_long,customer_rating,date_registered) VALUES
	       ('$customer_name','$customer_phno','$customer_addr','$customer_lat','$customer_long','$customer_rating','$date')";

	    return insertQueryToDB($sql);

	}






	// ########################################################################################################################################## //



	public function getMinionDetails($minion_id)
	{
		$mysql_connection = DbConnectionHelper::connectDatabase();

		$sql = "SELECT  minion_id,minion_status,minion_phno,minion_lat,minion_long,minion_priority,minion_rating 
				FROM minions WHERE minion_id =  '$minion_id' ";

		$result = mysqli_query($mysql_connection, $sql) or die("Error in Selecting " . mysqli_error($mysql_connection));
		
		
		// DbConnectionHelper::disconnectDatabase($mysql_connection);

		return convertQueryResultToJSON($result);


	}

	public function setMinionDetails($minion_name,$minion_phno,$minion_addr,$minion_lat,$minion_long,$minion_priority,$minion_rating,$date)
	{

		$sql = "INSERT INTO minions (minion_name,minion_phno,minion_addr,minion_lat,minion_long,minion_priority,minion_rating,date_registered) VALUES
	       ('$minion_name','$minion_phno','$minion_addr','$minion_lat','$minion_long','$minion_priority','$minion_rating','$date')";

	    return insertQueryToDB($sql);


	}


	public function updateMinionLocation($minion_id,$minion_lat,$minion_long)
	{
		
		$sql = "UPDATE minions SET minion_lat = '$minion_lat', minion_long = '$minion_long'
				WHERE minion_id = '$minion_id'";

	    return insertQueryToDB($sql);
	}



	public function updateMinionPriority($minion_id,$minion_priority)
	{

		$sql = "UPDATE minions SET minion_priority = '$minion_priority' 
				WHERE minion_id = '$minion_id'";

	    return insertQueryToDB($sql);
	}


	public function updateMinionRating($minion_id,$minion_rating)
	{

		$sql = "UPDATE minions SET minion_rating = '$minion_rating'
				WHERE minion_id = '$minion_id'";

	    return insertQueryToDB($sql);
	}


	// ########################################################################################################################################## //




	public function getDeliveryDetails($delivery_id)
	{

		$mysql_connection = DbConnectionHelper::connectDatabase();

		$sql = "SELECT  delivery_id ,merchant_id ,customer_id, minion_id ,status ,time_created ,time_completed  ,time_updated 
				FROM deliveries WHERE delivery_id =  '$delivery_id'";
		$result = mysqli_query($mysql_connection, $sql) or die("Error in Selecting " . mysqli_error($mysql_connection));
		
		
		DbConnectionHelper::disconnectDatabase($mysql_connection);

		return convertQueryResultToJSON($result);	

	}

	public function setDeliveryDetails($delivery_id,$merchant_id,$customer_id,$minion_id,$status,$time_created,$time_completed,$time_updated)
	{

		$sql = "INSERT INTO deliveries (delivery_id,merchant_id,customer_id,minion_id,status,time_created,time_completed,time_updated) VALUES
	       ('$delivery_id','$merchant_id','$customer_id','$minion_id','$status','$time_created','$time_completed','$time_updated')";

	    return insertQueryToDB($sql);

	}


}
















?>