<?php

$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "pampangas_inasal";

//Create connection
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

if(!$conn){
    die("Error: Failed to connect to database!");
}