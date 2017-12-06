<?php

/*********************************************************************
NAME: Chris Skiles
ZID:  z1638506
ASGN: 9
Summary: this is the standard connection info to connect to mySQL
**********************************************************************/ 

$host     = 'students';
$user     = 'z1638506';
$password = '1993Jan29';
$db       = 'z1638506';

$conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);
try  {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
catch(PDOException $error)  {
    echo 'ERROR: ' . $error->getMessage();
    }
?>