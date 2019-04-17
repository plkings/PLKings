<?php

	if($_SERVER['REQUEST_METHOD'] == 'GET'){

		$dbhost = '';
		$dbuser = '';
		$dppass = '';

		$conn = mysql_connect($dbhost, $dbuser,$dbpass);
		
		if(! $conn) {
			die('Could not connect: ' . mysql_error());
		}
		
		if(isset($_GET['dblocation']))
		{		
			$sql = ''; //sql query
			mysql_select_db(''); //Database name
			$retval = mysql_query($sql, $conn);
			
			if(! retval){
				die('Could not get data: ' . mysql_error());
			}
		}
	}
?>