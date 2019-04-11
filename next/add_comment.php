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

//if there is no errors,  connect to db, run query, and show success message
if($error == ''){
    $query = "INSERT INTO tbl_comment(comment_id, parent_comment_id, message,uid, comment_sender_name, date, grpid, vote)
            VALUES (NULL,'$commentusid ', '$comment_content','$commentnum' ,'$commentuser', CURRENT_TIMESTAMP, $groupnum, '' )";
  $score = mysqli_query($conn, $query);
  header("Location:index.php?groupid=".$groupnum);
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
