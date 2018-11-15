<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>User Profile</title>
      <link rel="stylesheet" type="text/css" href="./assets/home.css">
  </head>
  <body>

             <header>
               <div class="container">

                 <nav>
                   <ul>
                     <li class="sansserif"><a href="homepage.php">Home</a></li>
                     <li><a href="profile.php">Profile</a></li>
                     <li><a href="help.php">Groups</a></li>
                     <li><a href="help.html">Help</a></li>
                     <li style = "float:right" ><a href="#home">goODU</a></li>
                      <li style = "float:right" ><a href="index.php?logoutsuccess">Log - Out</a></li>

                   </ul>
                 </nav>
               </div>


             </header>


    <form class="" action="profile.php" method="post" enctype="multipart/form-data">
    <?php echo "Select image to upload for " . $_SESSION['uname'];
    ?>
      <input type="file" name="picupload" value="picupload">
      <input type="submit" name="submit" value="Upload">
    </form>

    <?php








     ?>

  </body>
</html>
