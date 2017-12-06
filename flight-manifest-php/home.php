<?php
/*****************************************************************
NAME: Chris Skiles
ID:   z1638506
ASGN: 9
SUMMARY: This is the home page of the website for assignment 9.
         it send a query to MySQL and prints the information in
         a table.
******************************************************************/

    include "header.html";               //standard html headerremove
    require "dbconn.php";                //database connection
    
    $sql = 'select * from flight';       //define query for the table
    $q = $conn->query($sql)              //send query and kill php if it returns an error   
         or die("ERROR: " . implode(":", $conn->errorInfo()));

    //table set up     
    echo '<table border="1". style="width:100%:">';     
    echo "<tr>
            <th> Flight Number </th>
            <th> Origination   </th>
            <th> Destination   </th>
            <th> Miles         </th>    
          </tr>";

    //populate table with results of query      
    while ($row = $q->fetch(PDO::FETCH_ASSOC))  {
        echo "<tr>";
        
            echo "<th>". $row["flightnum"] ."</th>";
            echo "<th>". $row["origination"]."</th>";
            echo "<th>". $row["destination"]."</th>";
            echo "<th>". $row["miles"]."</th>";
        
        echo  "</tr>";
        }
        
    echo "</table>";
    // end table
?>

</body>
</html>
