<?php
    session_start();

    if (isset($_SESSION['userID'])) {
      echo '<p class = "login-status"> Your logged in</p>';
    }
    else {
      echo '<p class = "login-status"> Your logged out</p>';
    }

    if (isset($_POST['submit'])) {
        require 'testconn.php';
        require ' loggingin.php';
     }
else {

    echo mysqli_connect_error($conn);

      }
 ?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Home</title>
  </head>
  <body>
      <!-- <p>Logged in</p> -->



  </body>
</html>
