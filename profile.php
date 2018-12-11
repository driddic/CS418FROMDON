<?php
    session_start();
    require 'testconn.php';
    include 'header.php';
?>
<main>

      <div id = "bigbox">

         <?php
         $sessname= $_SESSION['username'];
          $sql = "SELECT * FROM users WHERE uname = '".$sessname."' ";
          $result = mysqli_query($conn, $sql);

          if(mysqli_num_rows($result) > 0){
             // if one or more rows are returned do following
             // echo "be while";
              while ($results = mysqli_fetch_assoc($result)){

                  echo "<h2 style='text-align:center'>User Profile</h2>
                  <div class='card' align =center>
                    <img src='' alt='' style='width:100%'>
                    <h1>".$results['fname']." ".$results['lname']." </h1>
                    <form action='upload.php' method='post' enctype='multipart/form-data'>
                    <p> Select image to upload for ". $_SESSION['username']."</p>
                      <input type='file' name='picupload' value='picupload'>
                      <input type='submit' name='upload' value='Upload'>
                    </form>
                   </div>";
                 }
               }
        ?>
      </div>
</main>

<!-- // if(mysqli_fetch_assoc($result))
// {
//
//   //trying to get profile picture to display
      //need to fuse with code above
//   while ($row = mysqli_fetch_assoc($result))
//    {
//     $id = $row['userid'];
//     $sqlImg = "SELECT * FROM profileimg WHERE userid = '".$id."';";
//     $resultImg = mysqli_query($conn, $sqlImg);
//     while ($rowImg = mysqli_fetch_assoc($resultImg))
//     {
//       echo "<div>";
//       if($rowImg['status'] == 0)
//       {
//         echo "<img src = 'assets/profile".$id.".jpg'>";
//       }
//       else {
//         echo "<img src = 'assests/profile.png'>";
//       }
//       echo"<p>" .$row['uname']. "</p>";
//       echo "</div>";
//     }
//   }
// } -->
