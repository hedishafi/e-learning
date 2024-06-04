<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../index.css">
  <link rel="stylesheet" href="./style.css">
  <title>SHELL - E-LEARNING</title>
  <style>
    /* Additional CSS for pop-up */
    .popup {
      display: <?php echo isset($_GET['id']) ? 'block' : 'none'; ?>;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: white;
      padding: 20px;
      border: 1px solid #ccc;
      z-index: 9999;
    }
  </style>
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
        <li><a href="./userProgress.php">Progress</a></li>
        <li><a href="">Support</a></li>
        <li><a id="logout" href="../index.html">Logout</a></li>
        <li><?php
            $username = $_SESSION['username'];
            echo "@" . $username; ?></li>
      </ul>
    </div>
  </div>
  <div class="courseBody">
    <div class="header">
      <?php
      require_once('../db.php');
      $stmt = $conn->prepare("SELECT * FROM course");
      $stmt->execute();
      $result = $stmt->get_result();
      while ($row = $result->fetch_assoc()) {
        echo '<div class="card">';
        echo '<h1><a href="?id=' . $row['id'] . '">' . htmlspecialchars($row['course_title']) . '</a></h1>';
        echo '<p>' . htmlspecialchars($row['course_description']) . '</p>';
        echo '</div>';
      }
      ?>
    </div>
  </div>
  <div id="c-footer" class="footer">
    <h1>$HELL | <span>E-LEARNING</span></h1>
    <h4>2024</h4>
  </div>

  <div id="popup" class="popup">
    <div id="courseContents">
      <?php
      if (isset($_GET['id'])) {
        $course_id = $_GET['id'];
        $stmt = $conn->prepare("SELECT * FROM course_content WHERE course_id = ?");
        $stmt->bind_param("i", $course_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $course_sub_title = htmlspecialchars($row['course_sub_title']);
            $content = htmlspecialchars($row['content']);
            echo "<h3>$course_sub_title</h3>";
            echo "<p>$content</p>";
          }
        } else {
          echo "<p>No content available for this course.</p>";
        }
      } else {
        echo "<p>No course selected.</p>";
      }
      ?>
    </div>

    <div class="pop-action">
      <button onclick="window.location.href='courses.php'">Close</button>
      <?php

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_SESSION['username'])) {
          $username = $_SESSION['username'];
          $stmt = $conn->prepare("SELECT id FROM user WHERE username = ?");
          $stmt->bind_param("s", $username);
          $stmt->execute();
          $result = $stmt->get_result();

          if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_id = $row['id'];
            $stmt = $conn->prepare("INSERT INTO user_progress (course_id, user_id, completed) VALUES (?, ?, 1)");
            $stmt->bind_param("ii", $course_id, $user_id);
            $stmt->execute();
          }
        }
      }
      ?>

      <form method="post">
        <button type="submit" name="submit">Complete</button>
      </form>
    </div>


  </div>
</body>

</html>