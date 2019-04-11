<?php session_start();
include 'header.php';
include 'testconn.php';

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
$sessname =$_SESSION['username'];
$sessid = $_SESSION['userid'];
$currentgroup= $_POST['group'];
$fromtheform = $_POST['invite'];


    if (isset($fromtheform)) {
        //$remotegrp=$results['grpid'];
        //$name=$results["uname"];
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
                   header("Location:groupsettings.php?notice=goodinvite");
                  exit();
                }
              }
      }else {
        echo "nothing else ";
      }
 ?>
<!-- // <!DOCTYPE html>
// <html lang="en" dir="ltr">
//   <head>
//     <meta charset="utf-8">
//     <title></title>
//   </head>
//   <body>
//     <?php
//     if (!$currentgroup) {
//       echo "failed to get group";
//     }else if($currentgroup) {
//     ?>
//     <form action = 'groupsettings.php' method="post">
//       <?php
//       //query for members not in groups
//       $show = "SELECT uname FROM membership WHERE NOT grpid ='$currentgroup'";
//               echo "query ran:" .$show;
//               $see = mysqli_query($conn, $show);
//               if(mysqli_num_rows($see) > 0){
//                  // if one or more rows are returned do following
//               while ($results = mysqli_fetch_assoc($see)){
//                 // create a checkbox form to add them
//                 echo "  <input type='checkbox' name='invite' value='".$results["uname"]."'>".$results["uname"]." <br>";
//             }
//       }
//   ?>
//     <input type='submit' value='Submit'>
//   </form>
// <?php
// }else {
//   echo "no group at all";
// }
//  ?>
-->
  <?php

?>
