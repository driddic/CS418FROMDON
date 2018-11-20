<?php
    session_start();
    require_once 'testconn.php';
?>




    <main>
     <head>
       <meta charset="utf-8">
       <title>goODU</title>
       <link rel="stylesheet" type="text/css" href="./assets/home.css">
       <meta name="viewport" content="width=device-width, initial-scale=1">
       <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

     </head>
     <body>

            <header>
              <div class="container">
                <div class="w3-bar w3-light-grey w3-border w3-padding" >
       <a href="#" class="w3-bar-item w3-button w3-mobile">Home</a>
       <a href="#" class="w3-bar-item w3-button w3-mobile">Profile</a>
       <a href="#" class="w3-bar-item w3-button w3-mobile">Groups</a>
       <a href="#" class="w3-bar-item w3-button w3-mobile">Help</a>
       <a style = "float:right"href="logout.php" class="w3-bar-item w3-button w3-mobile">Logout</a>

       <form style = "float:right" action="" method="post">
       <input type="text" class="w3-bar-item w3-input w3-white w3-mobile" placeholder="Search Users and Groups..">
       <button class="w3-bar-item w3-button w3-grey w3-mobile">goODU</button>
       </form>
             </div>
            </div>
           </header>

                       <!-- SIDEBAR -->
              <div class="w3-sidebar s3 w3-dark-blue w3-bar-block" style= "width:15%">
                <h3 class ="w3-bar-item">
                   <?php  if (isset($_SESSION['uname'])){echo "Hello  " . $_SESSION['uname']; }
                      else { echo "not logged in";
                            header("Location: index.php?error=loginfirst");  }
                     ?>

               </h3>
               <a href="#" class="w3-bar-item w3-button">Group 1</a>
                 <a href="#" class="w3-bar-item w3-button">Group 2</a>
                 <a href="#" class="w3-bar-item w3-button">Group 3</a>
              </div>

              <!-- MESSAGE BOARD -->

              <div style="margin-left:15% ">
                     <div class="w3-container w3-grey w3-center">
                       <h1>My Group</h1>


                       <?php include 'loadmessage.php'; ?>

             </div>

             <div class="">

             </div>


     </body>
   </main>




 <!-- <nav>
//   <ul>
//     <li class="sansserif"><a href="homepage.php">Home</a></li>
//     <li><a href="profile.php">Profile</a></li>
//     <li><a href="help.html">Groups</a></li>
//     <li><a href="help.html">Help</a></li>
//     <li ><a href="#home">goODU</a></li>
//      <li ><a href="index.php?logoutsuccess">Log - Out</a></li>
//      <li><div class="searchbar">
//        <form action="" method="post">
//          <input type="text" name="search" placeholder="Search Profiles and Groups">
//          <button type="searchbut" name="button"><i class="fa fa-search"></i></button>
//        </form>
//           </div>
//        </li>
//
//   </ul>
// </nav> -->
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
