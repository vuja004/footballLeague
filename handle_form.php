<?php

$clubName = $_POST['club_name'];
$clubCity = $_POST['club_city'];

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

$sql = "INSERT INTO club (name, city)
VALUES ('{$clubName}', '{$clubCity}')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();