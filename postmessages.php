<?php
session_start();
require 'testconn.php';
include 'header.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['send'])) {



  if(empty($_POST["message_content"])){
   $error = '<p>Comment is required</p>';
   echo $error;
   //do I want to send the user back to the message box?
  }else{

   $comment_content = $_POST["message_content"];
   echo $comment_content;
   echo "</br>";
   $theid = $_POST["recip"];
   $messid = $_POST["sender"];
   $rand = rand(1,1000);


   $sql = "INSERT INTO messageroom(commentID, message, timestamp, recip, sender, threadID)
   VALUES (NULL,'$comment_content',CURRENT_TIMESTAMP ,'$theid','$messid','$rand') ";
   $yes=mysqli_query($conn, $sql);
   header("Location:messages.php?notice=sentmessage");
   exit();

   echo $sql;
  }

}

if (isset($_POST['reply'])) {

  if(empty($_POST["comment_content"])){
   $error = '<p>Comment is required</p>';
   echo $error;
   //do I want to send the user back to the message box?
  }else{

   $dm_content = $_POST["comment_content"];
   echo $dm_content;
   echo "</br>";
   $theid = $_POST["comment_rec"];
   $messid = $_POST["comment_name"];
   $dm_id= $_POST["thread_num"];



   $sql = "INSERT INTO messageroom(commentID, message, timestamp, recip, sender, threadID)
   VALUES (NULL,'$dm_content',CURRENT_TIMESTAMP ,'$theid','$messid','$dm_id') ";
   $yes=mysqli_query($conn, $sql);
   header("Location:messages.php?notice=sentmessage");
   exit();

   echo $sql;
  }

}





function setComments($conn)
{

  if (isset($_POST['commentsSubmit'])) {

    $date = $_POST['timestamp'];
    $comment =$_POST['comment'];
    $uid=$_SESSION['userid'];
    $uname = $_POST['username'];
    $currentgroup =$_GET['groupid'];
    $sql = " INSERT INTO messageroom (message, timestamp, userid, uname, grpid)
            VALUES ('$comment','$date','$uid','$uname','$currentgroup')";
    $rack = mysqli_query($conn, $sql);
  }
}
//test input for htmlspecialchars, removes backslashes and newlines, tabs, and extra space
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

//
// function switchContent($value='')
// {
//   // code...
// }
