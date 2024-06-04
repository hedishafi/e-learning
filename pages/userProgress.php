<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../index.css">
  <link rel="stylesheet" href="./style.css">
  <title>SHELL - E-LEARNING</title>
</head>

<body>
  <div class="navigation">
    <div class="logo">
      <h1>$HELL | E-LEARNING</h1>
    </div>
    <div class="navLinks">
      <ul>
        <li><a href="./index.php">Home</a></li>
        <li><a href="./courses.php">Courses</a></li>
        <li><a href="">Support</a></li>
        <li><a id="logout" href="../index.html">Logout</a></li>
        <li><?php
            $username = $_SESSION['username'];
            echo "@" . $username; ?></li>
      </ul>
    </div>
  </div>

  <div class="table-container">
    <?php
    require_once '../db.php';
    if (isset($_SESSION['username'])) {
      $username = $_SESSION['username'];
      $stmt = $conn->prepare("SELECT id FROM user WHERE username = ?");
      $stmt->bind_param("s", $username);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['id'];

        $stmt = $conn->prepare("SELECT course.course_number, course.course_title, user_progress.completed
                                  FROM user_progress
                                  JOIN course ON user_progress.course_id = course.id
                                  WHERE user_progress.user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
          echo "<table><tr><th>Course Number</th><th>Course Title</th></tr>";
          while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['course_number']}</td><td>{$row['course_title']}</td></tr>";
          }
          echo "</table>";
        }
      }
    }
    ?>
  </div>

</body>

</html>