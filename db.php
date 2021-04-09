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

	//function for string
	function encryptString($string)
	{
		$string = str_replace('"', '!1$#5', $string);
		$string = str_replace("'", "^-&~5", $string);
		return($string);
	}
	function decryptString($string)
	{
		$string = str_replace('!1$#5', '"', $string);
		$string = str_replace("^-&~5", "'", $string);
		return($string);
	}
	 
	//fuction get current URL
	function getCurrentPageURL() 
	{
		$pageURL = 'http';
		if (!empty($_SERVER['HTTPS'])) {
			if ($_SERVER['HTTPS'] == 'on') {
				$pageURL .= "s";
			}
		}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}
?>