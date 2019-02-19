<?php

require 'testconn.php';

$error = '';
$comment_content = '';
//$text = $_POST['comment_content'];
$parent_commentID = $_POST["parent_commentID"]

if(empty($_POST["comment_content"])){
 $error .= '<p class="text-danger">Comment is required</p>';
}

else{
 $comment_content = $_POST["comment_content"];
}

if($error == '')
{
 $query = " INSERT INTO message (parent_commentID, text ) VALUES ('".$parent_commentID."','".$comment_content."'); ";
 $statement = $conn->prepare($query);
 $statement->execute(array(':parent_commentID' => $_POST["messID"],':text'=> $comment_content));
 $error = '<label class="text-success">Comment Added</label>';
}

$data = array('error' => $error);

echo json_encode($data);

?>
