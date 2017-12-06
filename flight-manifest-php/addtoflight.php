<?php
/****************************************************************
   NAME: Chris Skiles
    ZID: z1638506
   ASGN: 10
SUMMARY: This page adds a passenger to a flight by creating an 
         entry for them in the manifest table. The date of flight
         and seat number are marked as TBD and would theoretically
         be changed on a different page.
****************************************************************/

    include 'header.html';                  //standard header
    require 'dbconn.php';                   //databasee connection
    
    $sql1 = 'select * from passenger';      //sql queries to populate the dropdown boxes
    $sql2 = 'select * from flight';
    
    echo '<form action="addtoflight.php" method="POST">';   //begin form         
        echo 'Passenger: ';
        echo '<select name="passenger">';                   //dropdown for passenger
        
        //populate the form with query results
        foreach($conn->query($sql1) as $row)  {
            echo '<option value="';
            echo $row["passnum"];
            echo '">';
            echo $row["lname"].', '.$row['fname'];
            echo '</option>';
        }

        echo '</select>';                                   //end passenger dropdown
        
        
        echo '<br> Flight Number: ';
        echo '<select name="flight">';                      //dropdown for flight number
        
        //populate dropdown box
        foreach($conn->query($sql2) as $row)  {
            echo '<option value="';
            echo $row["flightnum"].'">';
            echo $row["flightnum"].'</option>';
        }
        
        
        echo '</select>';                                   //end flight number dropdown
        echo '<br> <br> <input type="submit" /> <br>';                        
    echo '</form>';
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST')  {            //if information was sent to the page through POST
        $fnum = $_POST[flight];                             //store info in easier to use vars
        $pnum = $_POST[passenger];
        
        $stmt = $conn->prepare('INSERT INTO manifest        
            (flightnum, dateofflight, passnum, seatnum) VALUES
            (:flightnum, "TBD", :passnum, "TBD")');         //prepare insert statement
            
            $stmt->bindParam(':flightnum', $fnum);          //bind flight number and passenger number to the statement
            $stmt->bindParam(':passnum', $pnum);
            
        $stmt->execute();                                   //add passenger to the flight
        
        echo "Passenger added to flight.";
    }
    
?>

</body>