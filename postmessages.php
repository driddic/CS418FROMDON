<?php
session_start();
require 'testconn.php';
include 'header.php';
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if (isset($_POST['send'])) {



  if(empty($_POST["message_content"])){
   $error = '<p>Comment is required</p>';
   echo $error;
   //do I want to send the user back to the message box?
  }else{

   $comment_content = $_POST["message_content"];
   $comment_content = test_input($comment_content);
   echo $comment_content;
   echo "</br>";
   // $theid = $_POST["recipID"];
    $theguy = $_POST["recip"];
   $messid = $_POST["senderID"];
   $messguy = $_POST["sender"];
   $rand = rand(1,1000);


   $sql = "INSERT INTO messageroom(commentID, message, timestamp, senderID,fromUser, threadID)
   VALUES (NULL,'$comment_content',CURRENT_TIMESTAMP ,'$messid','$messguy','$rand') ";

   $querie = " INSERT INTO messagecontrol (threadId, userOne, userTwo)
               VALUES ('$rand','$theguy','$messguy' )";
   mysqli_query($conn, $sql);
   mysqli_query($conn, $querie);

   header("Location:messages.php?notice=sentmessage");
   exit();

   echo $sql;
   echo "</br>";
   echo $querie;

  }
}

//Reply in Messager Page
if (isset($_POST['reply'])) {

  if(empty($_POST["comment_content"])){
   $error = '<p>Comment is required</p>';
   echo $error;
   //do I want to send the user back to the message box?
  }else{

   $dm_content = $_POST["comment_content"];
   $dm_content = test_input($dm_content);
   echo $dm_content;
   echo "</br>";
   $messid = $_POST["comment_send_id"];
   $messname = $_POST["comment_send"];
   $dm_id= $_POST["thread_num"];

   $sql = "INSERT INTO messageroom(commentID, message, timestamp, senderID, fromUser, threadID)
   VALUES (NULL,'$dm_content',CURRENT_TIMESTAMP ,'$messid','$messname','$dm_id') ";
   mysqli_query($conn, $sql);
   header("Location:messages.php?notice=sentmessage");
   exit();

   echo $sql;
  }
}



//test input for htmlspecialchars, removes backslashes and newlines, tabs, and extra space
// function test_input($data)
// {
//   $data = trim($data);
//   $data = stripslashes($data);
//   $data = htmlspecialchars($data);
//   return $data;
// }
