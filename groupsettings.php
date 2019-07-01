<?php session_start();
include 'header.php';
include 'testconn.php';

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
$sessname =$_SESSION['username'];
$sessid = $_SESSION['userid'];


    if (isset($_POST['invitation'])) {

      // Has user already been invited

      

        $currentgroup= $_POST['group'];
        $fromtheform = $_POST['invite'];
        echo $fromtheform;
        $huh = "SELECT userid FROM users WHERE uname = '".$fromtheform."'";
        $hitit = mysqli_query($conn, $huh);
            echo "query 1: ".$huh;
            if(mysqli_num_rows($hitit) > 0){
               // if one or more rows are returned do following
            while ($result = mysqli_fetch_assoc($hitit)){
        $insert = " INSERT INTO membership (grpid,userid,uname,active)
                    VALUES ('".$currentgroup."','".$result["userid"]."','".$fromtheform."', '1'); ";
                    echo "query 2: ".$insert;
                    //running sql query above
                    $score = mysqli_query($conn, $insert);
                   header("Location:group.php?notice=goodinvite");
                  exit();
                }
              }
      }else {
        echo "no invite sent ";
      }
      //we want to run an UPDATE query to change the active status from 1 to 0
      //if user accepts an invite
      if (isset($_POST['status'])) {



              if(empty($_POST["sessid"])){
              echo "no session id retreived";
              }else{
               $sessid = $_POST["sessid"];
               echo "go sessid";
              }
              if(empty($_POST["groupid"])){
               echo "no group id retreived";
              }else{
               $id = $_POST["groupid"];
               echo "go group id";
              }

      $update = "UPDATE membership set active = 0 where userid = ".$sessid." AND grpid = ".$id."";
      mysqli_query($conn, $update);
      header("Location: group.php?notice=nowactive");
      exit();
    }

      else {
        echo "user is not active";
      }




 ?>
