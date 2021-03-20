<?php 
	//Database connection 
	$hostname='localhost';
	$username='root';
	$password='';
	$dbname='final_project';
	$port=3306;

	function query($sql)
	{
		global $hostname;
		global $username;
		global $password;
		global $dbname;
		global $port;

		$conn = new mysqli($hostname, $username, $password, $dbname, $port);
		
		//If connection is not successful, stop the program 
		if($conn->connect_error)
		{
			echo "Connection fail<br>";
			//Stop the program
			die($conn->connect_error);
		}

		// Run the query to get the results 
		$result = $conn->query($sql);

		// If there is no result ($result = null) then stop the program 
		if(!$result)
		{
			echo "SQL execution fail <br>";
			die($conn->error);
		}

		// Get all records from the results
		$rows = mysqli_fetch_all($result);

		return $rows;
	}

	function querynull($sql)
	{
		global $hostname;
		global $username;
		global $password;
		global $dbname;
		global $port;

		$conn = new mysqli($hostname, $username, $password, $dbname, $port);
		
		//If connection is not successful, stop the program 
		if($conn->connect_error)
		{
			echo "Connection fail<br>";
			//Stop the program
			die($conn->connect_error);
		}

		// Run the query to get the results 
		$result = $conn->query($sql);

		return $result;
	}

	
	function execsql($sql)
	{
		global $hostname;
		global $username;
		global $password;
		global $dbname;
		global $port;

		$conn = new mysqli($hostname, $username, $password, $dbname, $port);
		
		// If the connection is not successful, stop the program 
		if($conn->connect_error)
		{
			echo "Connection fail <br>";
			//Stop the program
			die($conn->connect_error);
		}

		// Run the query to get the results 
		$result = $conn->query($sql);
		return $result;
	}
	
?>