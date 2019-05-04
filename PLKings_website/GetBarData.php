<?php

	if($_SERVER['REQUEST_METHOD'] == 'GET'){

		$user = 'root';
        $password = 'root';
        $db = 'BarsDB';
        $host = 'localhost';
        $port = 8889;

        //Connecting to database
        $link = mysqli_init();
        $conn = mysqli_real_connect(
           $link,
           $host,
           $user,
           $password,
           $db,
           $port
		);
        
        if($conn)
        {
            if(isset($_GET['dbLocation']))
            {	
                //Get variable sent from .ajax call
                $dbLocation =  $_GET['dbLocation'];

                //Create and send sql query
                $sql = "SELECT * FROM Bars WHERE Borough='". $dbLocation ."'";
                $retval = mysqli_query($link, $sql);
                
                //Check if query is valid
                if($retval){
                    if(mysqli_num_rows($retval) > 0)
                    {
                        
                    }
                    else {
                        echo "No results found";
                    }
                }
                else{
                    echo "Error: " . mysqli_error($link);
                }
            }
        }
	} 
?>