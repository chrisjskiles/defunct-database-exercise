<?php
/***************************************************************
   NAME: Chris Skiles
    ZID: z1638506
   ASGN: 10
SUMMARY: This page removes passengers from flights. Until the 
         information is processed, this page is identical to
         the addtoflight.php page
***************************************************************/

    include 'header.html';                  //standard header
    require 'dbconn.php';                   //database connection 
    
    $sql1 = 'select * from passenger'; 
    $sql2 = 'select * from flight';
    
    echo '<form action="delfromflight.php" method="POST">';        
        echo 'Passenger: ';
        echo '<select name="passenger">';
        
        //populate the form with query results
        foreach($conn->query($sql1) as $row)  {
            echo '<option value="';
            echo $row["passnum"];
            echo '">';
            echo $row["lname"].', '.$row['fname'];
            echo '</option>';
        }

        echo '</select>';
        
        
        echo '<br> Flight Number: ';
        echo '<select name="flight">';
        
        //populate dropdown box
        foreach($conn->query($sql2) as $row)  {
            echo '<option value="';
            echo $row["flightnum"].'">';
            echo $row["flightnum"].'</option>';
        }
        
        
        echo '</select>';
        echo '<br> <br> <input type="submit" /> <br>';                        
    echo '</form>';
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST')  {    
        $fnum = $_POST[flight];
        $pnum = $_POST[passenger];
        
        //query to test if the passenger is on the flight
        $q = 'select * from manifest where flightnum="'.$fnum.'" and passnum="'.$pnum.'"';
        
        $count = $conn->query($q);
        
        if ($count->fetchColumn() == 0)  {      //if the query returned no results 
            echo 'ERROR: passenger not found on flight.';   //display an error 
        }
        
        else  {                                 //otherwise
            $stmt = 'DELETE FROM manifest WHERE flightnum="'.$fnum.'" and passnum="'.$pnum.'"';
            
            $conn->query($stmt);                //delete passenger from flight
            
            echo 'Passenger removed from flight.';
        }
    }
    
?>

</body>