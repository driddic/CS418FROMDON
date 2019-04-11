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
if(empty($_POST["comment_content"])){
 $error .= '<p class="text-danger">Comment is required</p>';
}else{
 $comment_content = $_POST["comment_content"];
 echo "go comment_content";
 echo "</br>";
}

if(empty($_POST["comment_name"])){
 $error .= '<p class="text-danger">No user</p>';
}else{
 $commentuser = $_POST["comment_name"];
 echo "go comment_name";
 echo "</br>";
}

 if(empty($_POST["group_num"])){
 $error .= '<p class="text-danger">No group selected</p>';
}else{
 $groupnum = $_POST["group_num"];
 echo "go group_num";
 echo "</br>";
}

if(empty($_POST["comment_time"])){
$error .= '<p class="text-danger">No time input</p>';
}else{
$dateandtime = $_POST["comment_time"];
echo "go time";
echo "</br>";
}

if(empty($_POST["comment_num"])){
$commentnum = $_POST["comment_number"];
}else{
$error .= '<p class="text-danger">No comment id</p>';
echo "complete";
echo "</br>";
}

//if there is no errors,  connect to db, run query, and show success message
if($error == ''){
  $query = "INSERT INTO tbl_comment(comment_id, parent_comment_id, message, comment_sender_name, date, grpid)
            VALUES (NULL, $commentnum , '$comment_content', '$commentuser', CURRENT_TIMESTAMP, $groupnum )";
  $score = mysqli_query($conn, $query);
  header("Location:homepage.php?groupid=".$groupnum);
  exit();
            //for debugging!!!!
            // echo "The comment is ".$comment_content;
            // echo "</br>";
            // echo "This is group number ".$groupnum;
            // echo "</br>";
            // echo "The query is ".$query;
            // $error = '<label class="text-success">Comment Added </label>';

}
//displaying the error message
$data = array('Message:'  => $error);
echo "</br>";
echo json_encode($data);

?>
