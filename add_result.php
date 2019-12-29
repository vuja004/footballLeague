<?php

$seasonId = $_POST['selected_season'];
$homeClubId = $_POST['selected_home_club'];
$awayClubId = $_POST['selected_away_club'];
$homeClubGoals = (int)$_POST['home_club_goals'];
$awayClubGoals = (int)$_POST['away_club_goals'];

if ($homeClubId === $awayClubId) {
    echo "Team cannot play against itself!";
    die;
}

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

//Provjera da li postoji mec
$sql = "SELECT * FROM result WHERE home_club_id = $homeClubId AND away_club_id = $awayClubId AND season_id = $seasonId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Match is already played!";
    die;
}

$sql = "INSERT INTO result (season_id, home_club_id, away_club_id, home_club_goals, away_club_goals)
VALUES ({$seasonId}, {$homeClubId}, {$awayClubId}, {$homeClubGoals}, {$awayClubGoals})";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully" . "<br>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

if ($homeClubGoals > $awayClubGoals) {
    $sql = "UPDATE club_season SET points = points + 3 WHERE club_id = $homeClubId AND season_id = $seasonId";
} else if ($homeClubGoals === $awayClubGoals) {
    $sql = "UPDATE club_season SET points = points + 1 WHERE season_id = $seasonId AND club_id IN ($awayClubId, $homeClubId)";
} else {
    $sql = "UPDATE club_season SET points = points + 3 WHERE club_id = $awayClubId AND season_id = $seasonId";
}

if ($conn->query($sql) === TRUE) {
    echo "club_season table updated" . "<br>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
