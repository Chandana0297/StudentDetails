<?php

// database details
$host = 'localhost';
$user = 'chandana';
$pass = 'Admin@123';
$dbname = 'studentDetails';

// create connection to database
$connect = new mysqli($host,$user,$pass);

// Check if connection is success
if($connect->connect_error){
    die('Connection failed: '.$connect->connect_error);
}

?>