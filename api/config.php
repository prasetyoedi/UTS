<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sait_db_uts";

header('Content-Type: application/json');

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}