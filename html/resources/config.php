<?php
$servername = "23.239.20.106";
$username = "testuser";
$password = "password";
$dbname = "hospital";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Common Paths
/*
defined("ROOT_PATH")
  or define("ROOT_PATH", realpath(dirname(__FILE__).'../'));

defined("RESOURCE_PATH")
  or define("RESOURCE_PATH", realpath(dirname(__FILE__).'../'));
 */
?>
