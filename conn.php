<?php
$servername = "localhost";
$db_username = "root";
$db_password = "";

$conn = mysqli_connect($servername, $db_username, $db_password);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
