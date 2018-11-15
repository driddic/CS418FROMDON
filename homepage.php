<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>goODU</title>
    <link rel="stylesheet" type="text/css" href="./assets/home.css">
  </head>
  <body>

         <header>
           <div class="container">

             <nav>
               <ul>
                 <li class="sansserif"><a href="homepage.php">Home</a></li>
                 <li><a href="profile.php">Profile</a></li>
                 <li><a href="help.html">Groups</a></li>
                 <li><a href="help.html">Help</a></li>
                 <li style = "float:right" ><a href="#home">goODU</a></li>
                  <li style = "float:right" ><a href="index.php?logoutsuccess">Log - Out</a></li>

               </ul>
             </nav>
           </div>


         </header>


         <?php

                   if (isset($_SESSION['uname'])) {

                     //  $_SESSION['username'] = $_POST;
                     echo "Hello ". $_SESSION['uname'];
                    // echo '<a href="logout.php?logout">Logout</a>';

                     }

                     else {
                       echo "You never logged in bro";
                       header("Location: index.php");
                     }

       ?>
  </body>
</html>

<!--
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
// -->
