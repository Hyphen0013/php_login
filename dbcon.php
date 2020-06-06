<?php

$server = 'localhost';
$user = "hyphen";
$password = "password";
$db = "login_task";


$conn = mysqli_connect($server, $user, $password, $db);

if($conn->connect_error) {
    die("Connection failed: " .mysqli_connect_error());
} 

// $sql = "INSERT INTO users (name, email, sex, phone, password) VALUES ('one', 'one@gmail.com', 'Male', '8888888888', '123456')";
/*
if($con->query($sql) === TRUE) {
    echo "Inserted";
} else {
    echo "Error: " .$sql. "<br>" .$con->error;
}
*/