<?php
/*********************************************************************
NAME: Chris Skiles
ZID:  z1638506
ASGN: 9
Summary: This is the flights page for assignment 9. When the user
         selects and submits a flight number from the drop down
         box it lists the name of every passenger on that flight.
**********************************************************************/
    
    //standard header and connection information
    include "header.html";  
    require "dbconn.php";

    //query from dropdown box
    $options = 'select * from flight';
    
    //form definition using post method
    echo '<form action="flights.php" method="POST">';
        echo '<select name="flight">';
        
        foreach($conn->query($options) as $row)  {
            echo '<option value="';
            echo $row["flightnum"];
            echo '">';
            echo $row["flightnum"];
            echo '</option>';
        }
        
        echo '</select>';
        echo '<br> <br> <input type="submit" /> <br>';
    
    echo '</form>';
    //end form
    
    //if the transmission method was POST then print the passengers
    //on the selected flight
    if ($_SERVER['REQUEST_METHOD'] == 'POST')  {
        $flight = $_POST[flight];
        
        //query to fetch passenger info
        $result = 'select fname, lname from passenger where passnum = any
                  (select passnum from manifest where flightnum like "'.$flight.'")';
        
        //send query to mySQL
        $q = $conn->query($result);
        
        //print results of query
        while($row = $q->fetch(PDO::FETCH_ASSOC))  {
            echo $row['fname'];
            echo '  ';
            echo $row['lname'].'<br>';
        }        
    }
?>

</body>
</html>