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
                $sql = " SELECT * FROM Bars WHERE Borough='". $dbLocation ."' ";
                $retVal = mysqli_query($link, $sql);
                
                //Check if query is valid
                if($retVal){
                    
                    //Adding location to array
                    $returnArray = array();
                    $returnArray['location'] = $dbLocation;

                    if(mysqli_num_rows($retVal) > 0)
                    {   
                        $barArray = array();

                        //Add bar information to array for each bar
                        while($row = mysqli_fetch_array($retVal, MYSQLI_ASSOC))
                        {

                            
                            //Gather Bar information
                            $row_array['BarName'] = $row['Name'];
                            $address = $row['Street'] . ", " . $row['City'] . ", " . $row['State'] . " " . $row['Zip'];
                            $row_array['BarAddress'] = $address;
                            $row_array['BarID'] = $row['Bar_id'];

                            $barSpecialQuery= "SELECT * FROM Bar_specials WHERE Bar_id='". $row_array['BarID'] ."'";
                            $barSpecial = mysqli_query($link, $barSpecialQuery);

                            if($barSpecial)
                            {
                                $barSpecialArray = array();

                                //Here is where it fails
                                if(mysqli_num_rows($barSpecial) > 0)
                                {
                                    while($row2 = mysqli_fetch_array($barSpecial, MYSQLI_ASSOC))
                                    {
                                        //Apply bar specials to day; 0=Sundayi
                                        $day = $row2['Day'];
                                        $row_array2["Special"] = $row2['Specials'];
                                        $row_array2["Hours"] = $row2['Hours'];
                                        $row_array2["AgeReqs"] = $row2['AgeReqs'];
                                        

                                        array_push($barSpecialArray, $row_array2);
                                    }
                                    //Needs to be rename
                                    $row_array['Bars_Specials'] = $barSpecialArray;
                                    //array_push($row_array, $row_array2);
                                }
                                else{

                                }
                           }
                           else{
                                echo "Error: " . mysqli_error($link);
                           }
                           
                            array_push($barArray, $row_array);
                        }
                    }
                    else {
                        echo "No results found";
                    }

                    //Add bar array into main array
                    $returnArray['Bars'] = $barArray;
                    echo json_encode($returnArray);
                }
                else{
                    echo "Error: " . mysqli_error($link);
                }
            }
        }
	} 
?>