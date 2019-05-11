<?php

include 'testconn.php';
include 'group.php';
//session_start();
///
///
/// Group Creation
///
///
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

//if indeed the submit button was clicked....
if (isset($_POST['groupsubmit'])) {
    // add group to the database with the user who submitted the file as the owner
    //initialize var
    $groupname=test_input($_POST['groupname']);
    $access = $_POST['access'];

    //if box is empty
    if(empty($groupname)){
      header("location: group.php?empty=nogrpname");
    }

      //if group name is taken
      $grpcheck = "SELECT * FROM groups WHERE grpname = '".$groupname."';";
      $check = mysqli_query($conn,$grpcheck);
      if(mysqli_num_rows($check) > 0) {
         header("Location: group.php?error=grptaken");
         exit();
       }
       $sql= "INSERT INTO groups(grpname, owner, access)
       VALUES('".$groupname."','".$sessname."', '".$access."')";
       $grpmake = mysqli_query($conn, $sql);

       // echo "good insert: " ;
       //place the group creator in the group the user made.

          $last_id = mysqli_insert_id($conn);
          // echo "New record created successfully. Last inserted ID is: " . $last_id;

          $sqlagain= "INSERT INTO membership (grpid,userid) VALUES ('".$last_id."','".$sessid."');";
           $userin = mysqli_query($conn, $sqlagain);
           echo "inserted membership";
           Header("location: group.php?group=allgood");

           exit();

           ///these next few lines will be for the people
           $admin= "INSERT INTO membership(grpid,userid,uname,active) VALUES('".$last_id."',9, 'admin', 0)";
           $adminin = mysqli_query($conn,$admin);

    }

// else(!isset($_POST['groupsubmit'])) {
//   header("location: group.php?error=grpsubmit");
//   exit();
// }
mysqli_close($conn);
