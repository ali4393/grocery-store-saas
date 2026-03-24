<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "the_grocery_db";
$port = 3307; 


$conn = mysqli_connect($host, $user, $pass, $dbname, $port);


if (!$conn) {
    die("❌ Connection failed: " . mysqli_connect_error());
}


mysqli_set_charset($conn, "utf8mb4");
?>