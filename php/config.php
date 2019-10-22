<?php



$host       = "localhost";
$username   = "root";
$password   = "Got314159!";
$dbname     = "mydb"; 
$dsn        = "mysql:host=$host;dbname=$dbname"; 
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );
?>