<?php
    session_start();
    require 'testconn.php';
    include 'header.php';
    $sessname= $_SESSION['username'];
    $sessid= $_SESSION['userid'];
    $pickid= $_GET['uid'];

    //this query is to count how many posts an user has made.
    $sql= "SELECT count(comment_id) FROM tbl_comment
               WHERE uid = '".$pickid."'" ;
               $acResults=mysqli_query($conn,$sql);
               $find = mysqli_fetch_assoc($acResults);
               $rep = $find['count(comment_id)'];
               //may need and
?>
<main>
<div id = "bigbox">
<?php
//What to display if the the logged in user is the same as the user profile being viewed
if ($sessid == $pickid) {

  $sqlone = "SELECT * FROM users WHERE userid = '".$sessid."' ";
  $result = mysqli_query($conn, $sqlone);

  if(mysqli_num_rows($result) > 0){
      while ($results = mysqli_fetch_assoc($result)){
        $sqlImg =" SELECT * FROM profileimage WHERE userid = '$sessid' ";
        $resultImg = mysqli_query($conn, $sqlImg);
        while ($rowImg = mysqli_fetch_assoc($resultImg)){
          echo "<h2 style='text-align:center'>User Profile</h2>
                <div>";



            if ($rowImg['status'] == 0) { //put a class on it
              //gravatar code
              if ($rowImg['keep'] == 0) {
              //if user elects to keep the gravatar as default
              //show the gravatar
              $email = $results["email"];
              echo $email;
              $default = 'assets/profile'.$sessid.'.png';
              $size = 180;
             $grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
                    echo "<img src='$grav_url' alt='gravatar' />";
              }else {
                // code...
                    echo "<img src = 'assets/profile".$sessid.".jpg'>";
                    echo "<img src = 'assets/profile".$sessid.".png'>";
                  }
            //else (no image has been uploaded or gravatar option has not been selected)
            }else {
              echo "<img src = 'assets/profile.png'>";
            }
            $sqlfive= "SELECT count(comment_id) FROM tbl_comment
                       WHERE comment_sender_name = '".$sessname."'" ;
            $actResults=mysqli_query($conn,$sqlfive);
            $find = mysqli_fetch_assoc($actResults);

            echo "<h1>".$results['fname']." ".$results['lname']." </h1>";

            echo "<p> Activity: ".$find['count(comment_id)']." Posts </p>";
            if ($rep <= 5){echo "Rookie";}
            elseif ($rep <=20 || $rep >= 6 ) {echo "Star";}
            elseif ($rep <=50 || $rep >=21) {echo "All-Star";}
            elseif($rep >=51) {
              echo "Hall of Fame";
            }else {
              echo "No rank";
            }
            echo"<form action='upload.php' method='POST' enctype='multipart/form-data'>
            <p> Select image to upload for ". $_SESSION['username']."</p>
            <input type='file' name='picupload' value='picupload'>
            <input type='submit' name='upload' value='Upload Picture'>
            </form>
            </div>";

        ?>
        <form action="upload.php" method="post">
          <p>Would you like to have your gravatar as your default profile image?</p>
          <input type="radio" name="option" value="yes" checked>Yes!
          <input type="radio" name="option" value="no">No
          <input type="hidden" name="name" value="<?php echo $sessid; ?>">
          <input type="submit" name="gravpick" value="Submit">
        </form>

        <?php
            }}}
        else {
          echo "no users found";
        }

}else {
//what the page should display if you view another users profile page

  $sql= "SELECT count(comment_id) FROM tbl_comment
             WHERE uid = '".$pickid."'" ;
  $acResults=mysqli_query($conn,$sql);
  $find = mysqli_fetch_assoc($acResults);

  $sqlone = "SELECT * FROM users WHERE userid = '".$pickid."' ";
  $theresult = mysqli_query($conn, $sqlone);
  if(mysqli_num_rows($theresult) > 0){
      while ($results = mysqli_fetch_assoc($theresult)){
        $sqlmg =" SELECT * FROM profileimage WHERE userid = '$pickid' ";
        $resultmg = mysqli_query($conn, $sqlmg);
        while ($rowmg = mysqli_fetch_assoc($resultmg)){
          echo "<h2 style='text-align:center'>User Profile</h2>
                <div>";

            if ($rowmg['status'] == 0) { //put a class on it
                    echo "<img src = 'assets/profile".$pickid.".jpg'>";
                    echo "<img src = 'assets/profile".$pickid.".png'>";

            }else {
              echo "<img src = 'assets/profile.png'>";
            }}

  echo "<h1>".$results['fname']." ".$results['lname']." </h1>";

  echo "<p> Activity: ".$find['count(comment_id)']." Posts </p>";
  if ($rep <= 5){echo "Rookie";}
  elseif ($rep <=20 || $rep >= 6 ) {echo "Star";}
  elseif ($rep <=50 || $rep >=21) {echo "All-Star";}
  elseif($rep >=51) {echo "Hall of Fame";}
  else {
    echo "no rank";
  }

  echo "  <form action ='messages.php' method= 'post'>
          <input type = 'hidden' name= 'searchedname' id = 'searchedname' value = ".$results['uname'].">
          <input type = 'hidden' name= 'searchedid' id = 'searchedid' value = ".$results['userid'].">
          <input type = 'Submit' name = 'submit' value= 'Message'>
        </form>
  </div>";
}}
}

      ?>
  </div>
</main>
