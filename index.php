<?php

$servername = "localhost";
$username = "root";
$password = "";
$db = "football_league";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name FROM club";
$result = $conn->query($sql);

$clubs = [];

while ($row = $result->fetch_assoc()) {
    $clubs[] = $row;
}

$sql = "SELECT id, name FROM season ORDER BY id DESC";
$result = $conn->query($sql);

$seasons = [];

while ($row = $result->fetch_assoc()) {
    $seasons[] = $row;
}

$conn->close();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<h2>Add New Result</h2>
<form action="add_result.php" method="post">
    Season
    <select name="selected_season">
        <?php
        foreach ($seasons as $season) {
            echo '<option value="' . $season['id'] . '">' . $season['name'] . '</option>';
            //echo "<option value='{$club['id']}'>{$club['name']}</option>";
        }
        ?>
    </select>
    <br><br>
    Home Club
    <select name="selected_home_club">
        <?php
        foreach ($clubs as $club) {
            echo '<option value="' . $club['id'] . '">' . $club['name'] . '</option>';
            //echo "<option value='{$club['id']}'>{$club['name']}</option>";
        }
        ?>
    </select>
    <br><br>
    Away Club
    <select name="selected_away_club">
        <?php
        foreach ($clubs as $club) {
            echo '<option value="' . $club['id'] . '">' . $club['name'] . '</option>';
            //echo "<option value='{$club['id']}'>{$club['name']}</option>";
        }
        ?>
    </select>
    <br><br>
    Home Club Goals
    <input type="number" name="home_club_goals">
    <br><br>
    Away Club Goals
    <input type="number" name="away_club_goals">
    <br><br>
    <button type="submit">Save</button>
</form>
<h2>Add New Club</h2>
<form action="handle_form.php" method="post">
    Name <input type="text" name="club_name"><br><br>
    City <input type="text" name="club_city"><br><br>
    <button type="submit">Save</button>
</form>
<h2>Add New Season</h2>
<form action="create_season_form.php" method="post">
    Season Name <input type="text" name="season_name">
    <button type="submit">Save</button>
</form>
</body>
</html>