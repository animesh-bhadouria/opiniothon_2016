<?php

// require the onfiguration. Make sure the config.php symlink is correct.
require_once './config.php';

/* Class DbConnectionHelper which contains basic methods to create/destroy mysql connection
 *
 */

class DbConnectionHelper
{

	// public function to create a new mysql connection
	public function connectDatabase()
	{
		if (($mysql_connection = mysqli_connect(mysql_HOST, mysql_USER, mysql_PASSWORD, mysql_DATABASE)) === false)
		{
			 die("Error cannot connect to database." . mysqli_error($mysql_connection));
		}	
		return $mysql_connection;
	}


	// public function to close an existing mysql connection
	public function disconnectDatabase($mysql_connection)
	{
		mysqli_close($mysql_connection);
	}

}



