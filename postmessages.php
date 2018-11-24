<?php

session_start();

function setComments($conn)
{

  if (isset($_POST['commentsSubmit'])) {

    $date = $_POST['timestamp'];
    $comment =$_POST['comment'];
    $uname=$_SESSION['uname'];
    $sql = " INSERT INTO messageroom (message, timestamp, username) VALUES ('$comment','$date','$uname')";
    $rack = mysqli_query($conn, $sql);
  }
}

// function test_input($data)
// {
//   $data = trim($data);
//   $data = stripslashes($data);
//   $data = htmlspecialchars($data);
//   return $data;
// }
