<?php
session_start();
include 'testconn.php';
$pers=$_POST['user_id'];
if (isset($_POST['up'])) {
  echo "it went up";
  $goUp=$_POST['up'];
  $incre="UPDATE tbl_comment SET voteup = voteup + 1 WHERE comment_id = '$goUp'";
  mysqli_query($conn,$incre);
  $blah="INSERT INTO `voter`(`userid`, `commentid`) VALUES ('$pers','$goUp')";
  mysqli_query($conn,$blah);
  header("Location:homepage.php");
}

elseif (isset($_POST['down'])) {
  echo "it went down";
  $goLow=$_POST['down'];
  $decres="UPDATE tbl_comment SET votedown = votedown + 1 WHERE comment_id = '$goLow'";
  mysqli_query($conn,$decres);
  $blah="INSERT INTO `voter`(`userid`, `commentid`) VALUES ('$pers','$goLow')";
  mysqli_query($conn,$blah);
  header("Location:homepage.php");
}
else {
  echo "no vote";
}?>
