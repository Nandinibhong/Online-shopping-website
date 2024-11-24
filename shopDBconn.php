<?php
$localhost = "localhost";
$database = "shopping_cart";
$username = "root";
$password = "";
$conn = new mysqli($localhost, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>