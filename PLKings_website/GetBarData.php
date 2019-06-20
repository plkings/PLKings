<?php

    function CreateDOM(DOMDocument $domObject, $element, $attribute, $value){
        $div = $domObject->createElement($element);
        $divAttribute = $domObject->createAttribute($attribute);
        $divAttribute->value = $value;
        $div->appendChild($divAttribute);
        return $div;   
    }

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
                    
                    //Create bar-card div with location class name
                    $dom = new DOMDocument();
                    
                    //Crate the dom objects
                    $barCardDiv = CreateDOM($dom, "div", "class", 'card bar-card ' . str_replace(' ', '_', $dbLocation));
                    $rowDiv = CreateDOM($dom, "div", "class", "row no-gutters");
                    
                    $logoContainerDiv = CreateDOM($dom, "div", "class", "col- logo-container");
                    $barInfoContainerDiv = CreateDOM($dom, "div", "class", "bar-info-container");
                    $barInfoDiv = CreateDOM($dom, "div", "class", "card-body bar-info");

                    $barSpecialsContainerDiv = CreateDOM($dom, "div", "class", "col- bar-special-container");
                    $daySpecialContainer = CreateDOM($dom, "div", "class", "day-special-container"); 

                    if(mysqli_num_rows($retVal) > 0)
                    {   
                        //$barArray = array();

                        //Add bar information to array for each bar
                        while($row = mysqli_fetch_array($retVal, MYSQLI_ASSOC))
                        {
                            
                            //Gather Bar information
                            //$row_array['BarName'] = $row['Name'];
                            $address = $row['Street'] . ", " . $row['City'] . ", " . $row['State'] . " " . $row['Zip'];
                            //$row_array['BarAddress'] = $address;
                            //$row_array['BarID'] = $row['Bar_id'];

                            $barTitle = CreateDOM($dom, "h5", "class", "card-title");
                            $barTitle->appendChild($dom->createTextNode($row['Name']));
                            
                            $barAddress = CreateDOM($dom, "p", "class", "card-subtitle");
                            $barAddress->appendChild($dom->createTextNode($address));

                            $barInfoDiv->appendChild($barTitle);
                            $barInfoDiv->appendChild($barAddress);

                            $barSpecialQuery= "SELECT * FROM Bar_specials WHERE Bar_id='". $row['Bar_id'] ."'";
                            $barSpecial = mysqli_query($link, $barSpecialQuery);

                            if($barSpecial)
                            {
                                
                                //$barSpecialArray = array();
                                

                                if(mysqli_num_rows($barSpecial) > 0)
                                {
                                    
                                    while($row2 = mysqli_fetch_array($barSpecial, MYSQLI_ASSOC))
                                    {
                                        //Apply bar specials to day; 0=Sunday
                                        //$row_array2["AgeReqs"] = $row2['AgeReqs'];

                                        $dayDiv = CreateDOM($dom, "p", "class", $row2['Day']);
                                        $dayDiv->appendChild($dom->createTextNode($row2['Specials']));

                                        $hoursDiv = CreateDOM($dom, "p", "class", "card-subtitle hours " .$row2['Day']);
                                        $hoursDiv->appendChild($dom->createTextNode($row2['Hours']));
                                        
                                        $hoursDiv2 = CreateDOM($dom, "p", "class", "card-subtitle hours " .$row2['Day']);
                                        $hoursDiv2->appendChild($dom->createTextNode($row2['HH_Hours']));

                                        //Add age reqs here

                                        $daySpecialContainer->appendChild($dayDiv);
                                        $barInfoDiv->appendChild($hoursDiv);
                                        $barInfoDiv->appendChild($hoursDiv2);
                                    }
                                    //Needs to be rename
                                    $row_array['Bars_Specials'] = $barSpecialArray;
                                    
                                }
                                else{

                                }
                                
                            }
                            else
                            {
                                echo "Error: " . mysqli_error($link);
                            }
                           
                            //array_push($barArray, $row_array);
                        }
                    }
                    else {
                        echo "No results found";
                    }

                    //Append the objects
                    $barInfoContainerDiv->appendChild($barInfoDiv);
                    $logoContainerDiv->appendChild($barInfoContainerDiv);
                    
                    $barSpecialsContainerDiv->appendChild($daySpecialContainer);

                    $rowDiv->appendChild($logoContainerDiv);
                    $rowDiv->appendChild($barSpecialsContainerDiv);

                    $barCardDiv->appendChild($rowDiv);
                    $dom->appendChild($barCardDiv);
                    
                    echo $dom->saveHTML();

                    //Add bar array into main array
                    //$returnArray['Bars'] = $barArray;
                    //echo json_encode($returnArray);
                    
                }
                else{
                    echo "Error: " . mysqli_error("Error: " . $link);
                }
                
            }
        }
	} 
?>