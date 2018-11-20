<?php

$servername = 'localhost';
$user = 'root';
$password='';
$db= 'university';
$conn = mysqli_connect("localhost","root","","university") OR die("Server Connection error");
mysqli_select_db($conn,$db) OR die("DB error");

$error = '';
//$comment_name = '';
$comment_content = '';

// if(empty($_POST["comment_name"]))
// {
//  $error .= '<p class="text-danger">Name is required</p>';
// }
// else
// {
//  $comment_name = $_POST["comment_name"];
// }

if(empty($_POST["comment_content"]))
{
 $error .= '<p class="text-danger">Comment is required</p>';
}
else
{
 $comment_content = $_POST["comment_content"];
}

if($error == '')
{
 $query = " INSERT INTO message (parent_commentID, text) VALUES (:parent_commentID, :text) ";
 $statement = $conn->prepare($query);
 $statement->execute(
  array(
   ':parent_commentID' => $_POST["messID"],
   ':text'    => $comment_content,
   //fix this line
  // ':comment_sender_name' => $_POST["userid"]
  )
 );
 $error = '<label class="text-success">Comment Added</label>';
}

$data = array(
 'error'  => $error
);

echo json_encode($data);

?>
