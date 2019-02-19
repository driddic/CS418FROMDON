<?php
require 'group.php';

$remotegrp=$results['grpid'];
///   query membership to validate
///
///   Adding member to Group from Group search
///
///
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
              $score = mysqli_query($conn, $sqltwo);
              header("Location:group.php?notice=goodjoin");
              exit();

}

}

if (isset($_POST['view'])) {
  // take user to group chat
  header("location: globalgroup.php?groupid=".$remotegrp["grpid"]."'");
  exit();

}
