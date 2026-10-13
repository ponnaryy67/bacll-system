<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "bac_system";

$conn = null;

try {
    $conn = @new mysqli($host, $user, $password, $dbname);
} catch (\mysqli_sql_exception $e) {
    $conn = null;
}

if ($conn && $conn->connect_error) {
    $conn = null;
}


