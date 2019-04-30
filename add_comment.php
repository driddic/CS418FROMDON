<?php
session_start();
require 'testconn.php';
//error handling code.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$error = '';
$comment_content = '';
// If comment field is empty display this error or else
// set whats in the comments to this variable
if (empty($_FILES['image']['name'])) {
echo "no photo";
$tool = '';
}else {
  // code...
echo  $image = $_FILES['image']['name'];
  // Get text
//  $image_text = mysqli_real_escape_string($db, $_POST['image_text']);
  // image file directory
  $target = "images/".basename($image);
  echo "</br>";
  echo $tool = basename($image);
  echo "</br>";
  if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
    echo "Image uploaded successfully";
  }else{
    $error .= "Failed to upload image";
  }
}

if(empty($_POST["comment_content"])){
 $error .= '<p class="text-danger">Comment is required</p>';
}else{
 $comment_content = mysqli_real_escape_string($conn, $_POST["comment_content"]);
 echo "go comment_content";
}
  echo "</br>";
if(empty($_POST["comment_name"])){
 $error .= '<p class="text-danger">No user</p>';
}else{
 $commentuser = $_POST["comment_name"];
 echo "go comment_name";
}
  echo "</br>";
if(empty($_POST["user_id"])){
 $error .= '<p class="text-danger">No user id</p>';
}else{
 $commentusid = $_POST["user_id"];
 echo "go comment_id";
}
  echo "</br>";
 if(empty($_POST["group_num"])){
 $error .= '<p class="text-danger">No group selected</p>';
}else{
 $groupnum = $_POST["group_num"];
 echo "go group_num";
}
  echo "</br>";
if(empty($_POST["comment_time"])){
$error .= '<p class="text-danger">No time input</p>';
}else{
$dateandtime = $_POST["comment_time"];
echo "go time";
}
$commentnum = $_POST["comment_id"];
//   if(empty($_POST["comment_id"])){
//     echo "</br>";
//     $error .= '<p class="text-danger">No comment id';
//   }else{
//     $commentnum = $_POST["comment_id"];
//     echo "comment number: ".$commentnum;
// }
    // echo "complete";

//if there is no errors,  connect to db, run query, and show success message
//displaying the error message
      if($error == ''){
      echo  $query = "INSERT INTO tbl_comment(comment_id, parent_comment_id, message, image, uid, comment_sender_name, date, grpid, voteup, votedown, code )
        VALUES (NULL,'$commentnum ', '$comment_content','$tool','$commentusid' ,'$commentuser', CURRENT_TIMESTAMP, $groupnum,'','','')";
        $score = mysqli_query($conn, $query);
        //header("Location:homepage.php?groupid='$groupnum'");
        //for debugging!!!!
        // echo "The comment is ".$comment_content;
        // echo "</br>";
        // echo "This is group number ".$groupnum;
        // echo "</br>";
        // echo "The query is ".$query;
        // $error = '<label class="text-success">Comment Added </label>';
      }
      $data = array('Time Out:'  => $error);
     echo json_encode($data);
?>
