<?php
include("config.php");
session_start();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "select * from Doctor";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "employee id: " . $row["eid"]. " - Specialization: " . $row["specialization"].  "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
