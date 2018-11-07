<?php
    session_start();

            if (isset($_SESSION['uname'])) {

              //  $_SESSION['username'] = $_POST;
              echo "Hello ". $_SESSION['uname'];
              echo '<a href="logout.php?logout">Logout</a>';

              }

              else {
                echo "You never logged in bro";
                header("Location: index.php");
              }



              // ini_set('display_errors', 1);
              // ini_set('display_startup_errors', 1);
              // error_reporting(E_ALL);
          // echo "string";
          //require 'index.php';

              //
              // if (isset($_POST['submit'])) {
              //    //require 'testconn.php';
              //    require 'index.php';
              //    require 'login.php';
              //    echo "string2";
              //  }


// else {
//
//     echo mysqli_connect_error($conn);
//
//       }
//
