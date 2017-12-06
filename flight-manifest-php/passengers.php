<?php
/*********************************************************************
NAME: Chris Skiles
ZID:  z1638506
ASGN: 9
Summary: This is the passengers page of assignment 9. It displays a
         drop down box of all the passengers in the database and when
         the user selects and submits a passenger it displays a list of
         all the flights the passenger is on.
**********************************************************************/
 
    //standard header and connection info
    include "header.html";
    require "dbconn.php";
    
    //query definition for drop down box
    $options = 'select * from passenger';
    
    //set up the drop down box
    echo '<form action="passengers.php" method="POST">';
        echo '<select name="passenger">';
        
        //populate the form with query results
        foreach($conn->query($options) as $row)  {
            echo '<option value="';
            echo $row["passnum"];
            echo '">';
            echo $row["lname"].', '.$row['fname'];
            echo '</option>';
        }
        
        echo '</select>';
        echo '<br> <br> <input type="submit" /> <br>';
    
    echo '</form>';
    //end form
    
    //if information was sent through post
    //display all flights the selected passenger is on
    if ($_SERVER['REQUEST_METHOD'] == 'POST')  {
        $pass = $_POST[passenger];
        
        //query to find flight information
        $result = 'select flightnum, origination, destination from flight where flightnum = any
                  (select flightnum from manifest where passnum = "'.$pass.'")';
        
        //send query to mySQL
        $q = $conn->query($result);
        
        //print out the results of query
        while($row = $q->fetch(PDO::FETCH_ASSOC))  {
            echo $row['flightnum'];
            echo '  ';
            echo $row['origination'];
            echo '  ';
            echo $row['destination'].'<br>';            
        }        
    }
?>

</body>
</html>    