<?php

    include "header.html";
    require "dbconn.php";
    
    $options = 'select * from passengers';
    
    echo '<form action="flights.php" method="post">';
    
    foreach($conn->query($options) as $row)  {
        echo '<option value="';
        echo $row["passnum"];
        echo '">';
        echo $row["lname"].', '.$row['fname'];
        echo '</option>';
    }
    
    echo '</form>';
?>

</body>
</html>    