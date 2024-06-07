<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "perpus";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function queryExecute($query) {
    global $conn;
    return $conn->query($query);
}

function queryReadData($query) {
    global $conn;
    $result = $conn->query($query);
    $rows = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
    }
    return $rows;
}
?>
