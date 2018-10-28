<?php
    session_start();

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if (isset($_POST['submit'])) {
       //require 'testconn.php';
       require 'index.php';
       require 'login.php';
    }

    if (isset($_SESSION['uname'])) {
        echo 'Your are login in';
        echo '<a href="logout.php?signout">Logout</a>';
      }
      else {
        echo ' You never logged in bro';
      //  header("Location: index.php");
      }




// else {
//
//     echo mysqli_connect_error($conn);
//
//       }
//
