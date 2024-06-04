<?php
include '../db.php';

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT username, password FROM user WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($db_username, $db_password);
    $stmt->fetch();
    if ($password == $db_password) {
        session_start();
        $_SESSION['username'] = $db_username;
        header('Location: ../pages/index.php');
        exit();
    } else {
        echo 'Invalid password';
    }
} else {
    echo 'Invalid username';
}

$stmt->close();
$conn->close();
