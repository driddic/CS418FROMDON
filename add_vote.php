<?php
session_start();
include 'testconn.php';

//variables declared
$pers=$_POST['user_id'];
$sessid = $_SESSION['userid'];
$postis=$_POST['up'];
$postdown=$_POST['down'];

if (isset($postis)) {
  //we want to check if the user already voted up on this post
  echo $watching = "SELECT COUNT(id) From voter WHERE userid = '$sessid' and commentid='$postis' ";
  //run query
  $votecheck=mysqli_query($conn, $watching);
  $row = mysqli_fetch_assoc($votecheck);

  // echo "row is: ". $row['COUNT(id)'];

  echo "<br>";
  echo $result = $row['COUNT(id)'];

//if there is results then make up this
      if ($result !== '0') {
        echo "<br>";
        echo "result is not zero, see...";
        echo "<br>";
        echo "result is: ".$result;
        echo "<br>";
        echo "looking to see if user voted down....";
        echo "<br>";

        //if the user is clicking the opposite vote
        $watch = "SELECT COUNT(id) From voter WHERE userid = '$sessid' and commentid='$postis' and down >= '1'  ";
        $voter = mysqli_query($conn, $watch);
        $line = mysqli_fetch_assoc($voter);
        $where = $line['COUNT(id)'];
        echo "This is where the user voted down: ". $where. "..... This should be a 0";
        //now we want to remove the vote up
        if ($where == '1') {
          // code...
          echo "<br>";
        echo "but, I will change that...";
          echo "<br>";
        $takeaway="UPDATE tbl_comment SET voteup = voteup + 1 WHERE comment_id = '$postis'";
        mysqli_query($conn,$takeaway);
        echo "adding a vote up";
          echo "<br>";
        //...and add a vote down
        $decres="UPDATE tbl_comment SET votedown = votedown - 1 WHERE comment_id = '$postis'";
        mysqli_query($conn,$decres);
        echo "substracting a vote down";
          echo "<br>";
        //now update the voter table
        $vt = "UPDATE voter set up = up + 1 where commentid = '$postis' and userid = ' $sessid'  ";
        mysqli_query($conn, $vt);
        echo "adding in the voter table";
          echo "<br>";
        //updating the down column
        $vtdown = "UPDATE voter set down = down - 1 where commentid = '$postis' and userid = '$sessid'";
        mysqli_query($conn,$vtdown);
        echo "finally the down column";
          echo "<br>";
          header("Location: homepage.php?msg=voted");

        }
          // what about if the user clicks up again???
          else {
            header("Location: homepage.php?error=alreadyvoted");
            echo "<br>";
            echo "you already voted up";
          }
        }

        // echo "<br>";
        // echo "post is: ".$postis;
        //if commentid match then do nothing

      elseif ($result == '0'){
        //if there is not results do this
        // echo "<br>";
        // echo "result is zero, see...";
        // echo "<br>";
        // echo "result is: ".$result;
        // echo "<br>";
        // echo "post is: ".$postis;
        $incre="UPDATE tbl_comment SET voteup = voteup + 1 WHERE comment_id = '$postis'";
        mysqli_query($conn,$incre);
        $blah="INSERT INTO `voter`(`userid`, `commentid`,`up`) VALUES ('$pers','$postis', 1)";
        mysqli_query($conn,$blah);
        header("Location:homepage.php?msg=votecount");
    }else {
      echo "no vote";
    }
  }


//now for down vote
elseif (isset($postdown)) {

  echo $watching = "SELECT COUNT(id) From voter WHERE userid = '$sessid' and commentid='$postdown' ";
  //run query
  $votecheck=mysqli_query($conn, $watching);
  $row = mysqli_fetch_assoc($votecheck);

  echo "<br>";
  echo $result = $row['COUNT(id)'];

  if ($result !== '0') {
    echo "<br>";
    echo "result is not zero, see...";
    echo "<br>";
    echo "result is: ".$result;
    //if result is not zero we want to see where the vote is
    echo "<br>";
    //where we see if the vote went up previously
    $watch = "SELECT COUNT(id) From voter WHERE userid = '$sessid' and commentid='$postdown' and up >= '1' ";
    $voter = mysqli_query($conn, $watch);
    $line = mysqli_fetch_assoc($voter);
    $where = $line['COUNT(id)'];
    echo "This is where the user voted up: ". $where. "..... This should be a 0";
    //now we want to remove the vote up
    if ($where == '1') {
      // code...
      echo "<br>";
    echo "but, I will change that...";
      echo "<br>";
    $takeaway="UPDATE tbl_comment SET voteup = voteup - 1 WHERE comment_id = '$postdown'";
    mysqli_query($conn,$takeaway);
    echo "substract a vote up";
      echo "<br>";
    //...and add a vote down
    $decres="UPDATE tbl_comment SET votedown = votedown + 1 WHERE comment_id = '$postdown'";
    mysqli_query($conn,$decres);
    echo "adding a vote down";
      echo "<br>";
    //now update the voter table
    $vt = "UPDATE voter set up = up - 1 where commentid = '$postdown' and userid = ' $sessid'  ";
    mysqli_query($conn, $vt);
    echo "substracting in the voter table";
      echo "<br>";
    //updating the down column
    $vtdown = "UPDATE voter set down = down + 1 where commentid = '$postdown' and userid = '$sessid'";
    mysqli_query($conn,$vtdown);
    echo "finally the down column";
      echo "<br>";
      header("Location: homepage.php?msg=voted");

    }
else {
  // code...
  echo "<br>";
  echo "you already voted down";
  header("Location: homepage.php?error=alreadyvoted");
}

    // echo "post is: ".$postis;
    //if commentid match then do nothing
  }
  elseif ($result == '0'){
    //if there is not results do this
    echo "<br>";
    echo "result is zero, see...";
    echo "<br>";
    echo "result is: ".$result;
    // echo "<br>";
    // echo "post is: ".$postdown;
    // echo "it went down";
    // $goLow=$_POST['down'];
    $decres="UPDATE tbl_comment SET votedown = votedown + 1 WHERE comment_id = '$postdown'";
    mysqli_query($conn,$decres);
    $blah="INSERT INTO `voter`(`userid`, `commentid`) VALUES ('$pers','$postdown')";
    mysqli_query($conn,$blah);
    header("Location:homepage.php?msg=voted");
}else {
  echo "no vote";
}

}
else {
  echo "no vote";
}?>
