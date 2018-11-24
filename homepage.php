<?php
    session_start();
    require_once 'testconn.php';
    include 'header.php';
?>
<main>
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
             <h1><?php echo "Group"; ?></h1>
             <?php include 'messages.php'; ?>
   </div>
  </body>
</main>
