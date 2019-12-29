<?php

$seasonName = $_POST['season_name'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "football_league";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO season (name)
VALUES ('{$seasonName}')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();