<?php
$localhost = "localhost";
$database = "shopping_cart";
$username = "root";
$password = "";
$conn = new mysqli($localhost, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['address']) && isset($_POST['Mnumber'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $address = $_POST['address'];
    $Mnumber = $_POST['Mnumber'];

    $stmt = $conn->prepare("INSERT INTO users(username, email, password, address, Mnumber) VALUES (?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Error in preparing statement: " . $conn->error);
    }
    $stmt->bind_param("sssss", $username, $email, $password, $address, $Mnumber);

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>