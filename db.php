<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "db";
$username = "dbuser";
$password = "dbpass";
$dbname = "dbname";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS user (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
} else {
    echo "Error creating user table: " . $conn->error . "<br>";
}

$sql = "CREATE TABLE IF NOT EXISTS course (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    course_number VARCHAR(10) NOT NULL,
    course_title VARCHAR(100) NOT NULL,
    course_description TEXT
)";

if ($conn->query($sql) === TRUE) {
} else {
    echo "Error creating course table: " . $conn->error . "<br>";
}

$sql = "CREATE TABLE IF NOT EXISTS course_content (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    course_id INT(6) UNSIGNED NOT NULL,
    course_sub_title VARCHAR(100) NOT NULL,
    content TEXT
)";

if ($conn->query($sql) === TRUE) {
} else {
    echo "Error creating course content table: " . $conn->error . "<br>";
}

$sql = "CREATE TABLE IF NOT EXISTS user_progress (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT(6) UNSIGNED NOT NULL,
    course_id INT(6) UNSIGNED NOT NULL,
    completed TINYINT(1) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
} else {
    echo "Error creating user progress table: " . $conn->error . "<br>";
}

?>
