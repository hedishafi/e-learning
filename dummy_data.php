<?php
include './db.php'; // Assuming db.php includes the database connection script

// Dummy data for users
$users = array(
    array('John Doe', 'john@example.com', 'password1'),
    array('Jane Smith', 'jane@example.com', 'password2')
);

// Dummy data for courses
$courses = array(
    array('CS101', 'Introduction to Computer Science', 'This course provides an overview of computer science fundamentals.'),
    array('MATH201', 'Advanced Mathematics', 'This course covers advanced topics in mathematics.')
);

// Dummy data for course content
$course_content = array(
    array(1, 'Introduction to CS101', 'Welcome to CS101 course.'),
    array(1, 'Data Types', 'This module covers different data types in programming.'),
    array(2, 'Algebra', 'This module covers algebraic concepts.')
);

// Insert dummy data into users table
foreach ($users as $user) {
    $name = $user[0];
    $username = $user[1];
    $password = $user[2];

    $sql = "INSERT INTO user (name, username, password) VALUES ('$name', '$username', '$password')";
    $conn->query($sql);
}

// Insert dummy data into courses table
foreach ($courses as $course) {
    $course_number = $course[0];
    $course_title = $course[1];
    $course_description = $course[2];

    $sql = "INSERT INTO course (course_number, course_title, course_description) VALUES ('$course_number', '$course_title', '$course_description')";
    $conn->query($sql);
}

// Insert dummy data into course_content table
foreach ($course_content as $content) {
    $course_id = $content[0];
    $course_sub_title = $content[1];
    $content_text = $content[2];

    $sql = "INSERT INTO course_content (course_id, course_sub_title, content) VALUES ('$course_id', '$course_sub_title', '$content_text')";
    $conn->query($sql);
}

// Insert dummy data into user_progress table
// Dummy data for user progress is not provided as it depends on user and course relationships

echo "Dummy data added successfully";

// Close the database connection
$conn->close();
?>
