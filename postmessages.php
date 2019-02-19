<?php
require 'testconn.php';
//session_start();

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
