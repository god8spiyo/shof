<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shof";

// Create connection
$dbcon = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$dbcon) {
    die("Connection failed: " . mysqli_connect_error());
}

    mysqli_set_charset($dbcon, 'utf8');


// mysqli_close($conn);
?>