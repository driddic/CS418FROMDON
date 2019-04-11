<?php

require 'group.php';

$remotegrp=$results['grpid'];
$name=$results["uname"];
///   query membership to validate
///
///   Adding member to Group from Group search
///
///
if (isset($_POST['status'])) {
//we want to run an UPDATE query to change the active status from 1 to 0

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
         echo "          go group id";
        }

$update = "UPDATE membership set active = 0 where userid = ".$sessid." AND grpid = ".$id."";
mysqli_query($conn, $update);
header("Location: group.php?notice=nowactive");
exit();
}
else {
  echo "something went wrong with the status";
}


if (isset($_POST['join'])) {

$sql = " SELECT * FROM membership WHERE userid ='".$sessid."'; ";
$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result) > 0) {
   header("Location: group.php?notice=ingroup");
   echo "h4";

   exit();
 }

 //query for membership to add
else {
  $insert = " INSERT INTO membership (grpid,userid)
              VALUES ('".$remotegrp."','".$sessid."'); ";
              //running sql query above
              $score = mysqli_query($conn, $insert);
              header("Location:group.php?notice=goodjoin");
              exit();

}

}

if (isset($_POST['view'])) {
  // take user to group chat
  header("location: globalgroup.php?groupid=".$remotegrp["grpid"]."'");
  exit();

}
