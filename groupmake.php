<?php

include 'testconn.php';


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
    else(!empty($groupname)){
      $grpcheck = "SELECT * FROM groups WHERE grpname = '$groupname'";
      $check = mysqli_query($conn,$sql);
      if(mysqli_num_rows($result) > 0) {
         header("Location: group.php?error=grptaken");
         exit();
       }
    }

$sql= "INSERT INTO groups(grpname, owner, access)
       VALUES('".$groupname."','".$sessname."', '".$access."')";
       $grpmake = mysqli_query($conn, $sql);

       // echo "good insert: " ;
       //place the group creator in the group the user made.
       if ($grpmake)
        {
          $last_id = mysqli_insert_id($conn);
          echo "New record created successfully. Last inserted ID is: " . $last_id;

          $sqlagain= "INSERT INTO membership (grpid,userid) VALUES ('".$last_id."','".$sessid."');";
           echo "inserted membership";
          $userin = mysqli_query($conn, $sqlagain);
           Header("location: group.php?group=allgood");

           exit();
        }
        //'''place new users in global group automatically ''' 6 = sportscenter


}
mysqli_close($conn);

else {
  header("location: group.php?error=grpsubmit");
  exit();
}


 ?>
