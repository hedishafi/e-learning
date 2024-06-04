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
        <li><a id="logout" href="../index.php">Logout</a></li>
        <li><?php
            $username = $_SESSION['username'];
            echo "@" . $username; ?></li>
      </ul>
    </div>
  </div>
  <div class="homeBody">
    <h2>Interesting Blogs</h2>
    <div class="header">
      <div class="card">
        <h1>Something Title</h1>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iusto possimus accusantium nam aperiam minima
          mollitia exercitationem cumque nemo fugit, assumenda at ab alias quasi, ullam aliquid, rem voluptates animi
          porro.</p>
      </div>

      <div class="card">
        <h1>Something Title</h1>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iusto possimus accusantium nam aperiam minima
          mollitia exercitationem cumque nemo fugit, assumenda at ab alias quasi, ullam aliquid, rem voluptates animi
          porro.</p>
      </div>

      <div class="card">
        <h1>Something Title</h1>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iusto possimus accusantium nam aperiam minima
          mollitia exercitationem cumque nemo fugit, assumenda at ab alias quasi, ullam aliquid, rem voluptates animi
          porro.</p>
      </div>
    </div>
    <br><br>
    <h2>New Community $hellers</h2>
    <div class="body">
      <table>
        <thead>
          <th>USERNAME</th>
          <th>NAME</th>
        </thead>
        <tbody>
          <?php
          require_once('../db.php');
          $query = 'SELECT * FROM user ORDER BY id DESC LIMIT 3';
          $stmt = $conn->prepare($query);
          $stmt->execute();
          $stmt->store_result();
          $stmt->bind_result($id, $name, $username, $pass);

          while ($stmt->fetch()) {
          ?>
            <tr>
              <td><?php echo $username; ?></td>
              <td><?php echo $name; ?></td>
            </tr>
          <?php
          }
          $stmt->close();
          ?>
        </tbody>
      </table>
    </div>
    <br><br>
    <h2>New Courses</h2>
    <div class="body2">
      <?php
      require_once('../db.php');

      $query = 'SELECT * FROM course ORDER BY id DESC LIMIT 3';
      $stmt = $conn->prepare($query);
      $stmt->execute();
      $stmt->store_result();
      $stmt->bind_result($id, $course_title, $course_description, $course_number);

      while ($stmt->fetch()) {
      ?>
        <div class="card">
          <h3><?php echo $course_title; ?></h3>
          <p><?php echo $course_description; ?></p>
        </div>
      <?php
      }
      $stmt->close();
      ?>


    </div>
  </div>
  <div class="footer">
    <h1>$HELL | <span>E-LEARNING</span></h1>
    <h4>2024</h4>
  </div>
</body>

</html>