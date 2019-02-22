<?php
session_start();
//add_comment.php

$connect = new PDO('mysql:host=localhost;dbname=university', 'root', '');
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
}

if(empty($_POST["comment_name"])){
 $error .= '<p class="text-danger">No user</p>';
}else{
 $commentuser = $_POST["comment_name"];
}

 if(empty($_POST["group_num"])){
 $error .= '<p class="text-danger">No group selected</p>';
}else{
 $groupnum = $_POST["group_num"];
}

if(empty($_POST["comment_time"])){
$error .= '<p class="text-danger">No time input</p>';
}else{
$dateandtime = $_POST["comment_time"];
}

if(empty($_POST["comment_id"])){
$error .= '<p class="text-danger">No comment id</p>';
}else{
$commentnum = $_POST["comment_id"];
}

//if there is no errors,  connect to db, run query, and show success message
if($error == ''){
  echo "The comment is ".$comment_content;
  echo "</br>";
  echo "This is group number ".$groupnum;
  echo "</br>";
  //echo "the comment name is ";

 $query = " INSERT INTO tbl_comment(parent_comment_id, comment, comment_sender_name, date, grpid)
            VALUES ($commentnum, $comment_content, $commentuser, $dateandtime ,$groupnum )";
            echo "The query is ".$query;
 // $statement = $connect->prepare($query);
 // $statement->execute(array( ':parent_comment_id' => $_POST["comment_id"],
 //                            ':comment'    => $comment_content,
 //                            ':comment_sender_name' => $commentuser,
 //                            ':groupid'=> $groupnum));

 $error = '<label class="text-success">Comment Added</label>';
 //header("location: globalgroup.php?error=commadd");
}

$data = array(
 'error'  => $error
);

echo json_encode($data);
// if(empty($_POST["comment_name"]))
// {
//  $error .= '<p class="text-danger">Name is required</p>';
// }
// else
// {
//  $comment_name = $_POST["comment_name"];
// }
?>
