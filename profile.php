<?php
    session_start();
    require 'testconn.php';
    include 'header.php';
?>
<main>

      <div id = "login-box">

        <?php
          $sql = "SELECT * FROM users;";
          $result = mysqli_query($conn, $sql);
          if(mysqli_fetch_assoc($result))
          {
            while ($row = mysqli_fetch_assoc($result))
             {
              $id = $row['userid'];
              $sqlImg = "SELECT * FROM profileimg WHERE userid = '".$id."';";
              $resultImg = mysqli_query($conn, $sqlImg);
              while ($rowImg = mysqli_fetch_assoc($resultImg))
              {
                echo "<div>";
                if($rowImg['status'] == 0)
                {
                  echo "<img src = 'assets/profile".$id.".jpg'>";
                }
                else {
                  echo "<img src = 'assests/profile.png'>";
                }
                echo"<p>" .$row['uname']. "</p>";
                echo "</div>";
              }
            }
          }

      ?>

          <form align = center action="profile.php" method="post" enctype="multipart/form-data">
          <?php echo "Select image to upload for " . $_SESSION['uname'];?>
            <input type="file" name="picupload" value="picupload">
            <input type="submit" name="submit" value="Upload">
          </form>

      </div>
</main>
