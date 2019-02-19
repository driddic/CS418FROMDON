<?php
    session_start();
    require 'testconn.php';
    include 'header.php';
?>
<main>

      <div id = "bigbox">

         <?php
         $sessname= $_SESSION['username'];
         $sessid= $_SESSION['userid'];
          $sqlone = "SELECT * FROM users WHERE uname = '".$sessname."' ";
          $result = mysqli_query($conn, $sqlone);

          if(mysqli_num_rows($result) > 0){

              while ($results = mysqli_fetch_assoc($result)){

              //  $id=$row['id'];
                $sqlImg =" SELECT * FROM profileimage WHERE userid = '$sessid' ";
                $resultImg = mysqli_query($conn, $sqlImg);
                while ($rowImg = mysqli_fetch_assoc($resultImg)){
                  echo "<h2 style='text-align:center'>User Profile</h2>
                        <div>";
                        //need to copy and paste this to the thread
                    if ($rowImg['status'] == 0) {
                      // I need to get the file extension
                      // public function get_file_extension($file_name)
                      // {
                      //   return pathinfo($file_name, PATHINFO_EXTENSION);
                      // }

                      echo "<img src = 'assets/profile".$sessid.".jpg'>";
                      echo "<img src = 'assets/profile".$sessid.".png'>";

                    }else {
                      echo "<img src = 'assets/profile.png'>";
                    }
                  echo "<h1>".$results['fname']." ".$results['lname']." </h1>
                  <form action='upload.php' method='POST' enctype='multipart/form-data'>
                  <p> Select image to upload for ". $_SESSION['username']."</p>
                    <input type='file' name='picupload' value='picupload'>
                    <input type='submit' name='upload' value='Upload Picture'>
                  </form>
                  </div>";
                }}}
                else {
                  echo "no users found";
                }
                ?>

                <!-- <?php

               //  $sqltwo = "SELECT * FROM users WHERE uname = '".$sessname."' ";
               //  $resultz = mysqli_query($conn, $sqltwo);
               //
               //  if(mysqli_num_rows($resultz) > 0){
               //     // if one or more rows are returned do following
               //     // echo "be while";
               //      while ($results = mysqli_fetch_assoc($resultz)){
               //    echo "<h2 style='text-align:center'>User Profile</h2>
               //    <div class='card' align =center>
               //      <img src='' alt='' style='width:100%'>
               //      <h1>".$results['fname']." ".$results['lname']." </h1>
               //      <form action='upload.php' method='POST' enctype='multipart/form-data'>
               //      <p> Select image to upload for ". $_SESSION['username']."</p>
               //        <input type='file' name='picupload' value='picupload'>
               //        <button type='submit' name='upload' value='Upload'>Upload </button>
               //      </form>
               //     </div>";
               //   }
               // }
               ?> -->
      </div>
</main>
