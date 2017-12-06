<?php
/*******************************************************************
   NAME: Chris Skiles
    ZID: z1638506
   ASGN: 10
SUMMARY: This page adds a passenger to the database.
********************************************************************/

    include "header.html";      //standard header
    require "dbconn.php";       //database connection
    
    echo '<form action="addpass.php" method="POST">';               //form definition
    
        echo 'First Name: <input type="text" name="fname"><br>';    //text boxes for first and last name
        echo 'Last Name: <input type="text" name="lname"><br>';
        
        echo '<input type="submit" value="Submit">';
        
    echo '</form>';                                                 //end form
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST')  {                    //if data was sent to this page
        $fname=$_POST[fname];                                       //store names in easier to use variable
        $lname=$_POST[lname];
        
        if (!(empty($fname) || empty($lname)))  {                           //Only add the passenger if both first and last name was entered
            $stmt = $conn->prepare("INSERT INTO passenger (fname, lname)    
                VALUES(:firstname, :lastname)");                            //prepare statement to insert passenger
                $stmt->bindParam(':firstname', $fname);                     //bind the names passed in to the statement
                $stmt->bindParam(':lastname', $lname);

            $stmt->execute();                                               //execute the statement
                
            echo "Passenger added";
        }
        
        else  {                             //if one of the inputs was empty display an error.
            echo "ERROR: Empty input";
        }
        
    }
?>

</body>    
   