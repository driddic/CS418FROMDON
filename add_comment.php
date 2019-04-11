<?php
session_start();
require 'testconn.php';
//error handling code.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if(isset($_POST['submit']))
{
$error = '';
$comment_content = '';
// If comment field is empty display this error or else
// set whats in the comments to this variable
if(empty($_POST["comment_content"])){
 $error .= '<p class="text-danger">Comment is required</p>';
}else{
 $comment_content = $_POST["comment_content"];
 echo "go comment_content";
}

if(empty($_POST["comment_name"])){
 $error .= '<p class="text-danger">No user</p>';
}else{
 $commentuser = $_POST["comment_name"];

 echo "go comment_name";
}
if(empty($_POST["comment_id"])){
 $error .= '<p class="text-danger">No user id</p>';
}else{
 $commentusid = $_POST["comment_id"];

 echo "go comment_id";
}
 if(empty($_POST["group_num"])){
 $error .= '<p class="text-danger">No group selected</p>';
}else{
 $groupnum = $_POST["group_num"];
 echo "go group_num";
}

if(empty($_POST["comment_time"])){
$error .= '<p class="text-danger">No time input</p>';
}else{
$dateandtime = $_POST["comment_time"];
echo "go time";
}

if(empty($_POST["comment_number"])){
$commentnum = $_POST["comment_number"];
}else{
$error .= '<p class="text-danger">No comment id</p>';
echo "complete";
}
if (empty($_POST["picupload"])) {
  // code...
  //from message board
        $file = $_FILES['picupload'];
        $file_name = $_FILES['picupload']['name'];
        $file_type = $_FILES['picupload']['type'];
        $file_tmp_name = $_FILES['picupload']['tmp_name'];
        $file_size = $_FILES['picupload']['size'];
        $file_error = $_FILES['picupload']['error'];

        $fileExt = explode('.', $file_name);
        $fileActualExt = strtolower(end($fileExt));
        $num = rand(1,500);

        $allowed = array('jpg','jpeg', 'png', 'pdf','txt','html','php',);

        if (in_array($fileActualExt, $allowed)) {
          if ($file_error == 0){
            if ($file_size < 1000000) {
              //change the status of the users prof"ile image
              $file_name_new = "message".$sessid."".$num.".".$fileActualExt;
              $file_destination = 'assets/messages/'.$file_name_new;
              // $sqlupdate = "UPDATE profileimage SET status = 0 and keep = 1 WHERE userid = '$sessid' ";
              // $result = mysqli_query($conn, $sqlupdate);
              move_uploaded_file($file_tmp_name,$file_destination);
              header("Location: homepage.php");
            }
            else {
              echo "Your file is too big!";
            //  header("Location: profile.php?error_size");
            }
          }
          else {
            echo "There was an error uploading your file!";
          //  header("Location: profile.php?error_upload");
          }
        }

        else {

          echo "You cannot upload files of this type!";
          //header("Location: profile.php?error_filetype");
        }
      }
      if($error == ''){
        echo  $query = "INSERT INTO tbl_comment(comment_id, parent_comment_id, message,uid, comment_sender_name, date, grpid, vote)
        VALUES (NULL,'$commentnum ', '$comment_content','$commentusid' ,'$commentuser', CURRENT_TIMESTAMP, $groupnum, '' )";
        $score = mysqli_query($conn, $query);
        header("Location:homepage.php?groupid=".$groupnum);
        //for debugging!!!!
        // echo "The comment is ".$comment_content;
        // echo "</br>";
        // echo "This is group number ".$groupnum;
        // echo "</br>";
        // echo "The query is ".$query;
        // $error = '<label class="text-success">Comment Added </label>';

      }
      $data = array('Message:'  => $error);
      echo "</br>";
      echo json_encode($data);
}else {
  echo "What happened??";
}

//if there is no errors,  connect to db, run query, and show success message
//displaying the error message

?>
