<?php
include '../db.php';

$name = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password'];
$password_confirmation = $_POST['password_confirmation'];

if ($password !== $password_confirmation) {
    echo 'Password and password confirmation do not match. Please try again.';
    exit();
}

$stmt = $conn->prepare("INSERT INTO user (name, username, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $username, $password); // No hashing here

if ($stmt->execute()) {
    header("Location: ./login.html");
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close(); // Close the statement

// Now close the connection
$conn->close();
?>
