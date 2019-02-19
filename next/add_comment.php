<?php

//add_comment.php

$connect = new PDO('mysql:host=localhost;dbname=university', 'root', '');
//error handling code.
$error = '';
$comment_content = '';
// If comment field is empty display this error or else
// set whats in the comments to this variable

if(empty($_POST["comment_content"])){
 $error .= '<p class="text-danger">Comment is required</p>';
 //include this class into the css file !!
}else{
 $comment_content = $_POST["comment_content"];
}

//if there is no errors,  connect to db, run query, and show success message
if($error == ''){
 $query = " INSERT INTO tbl_comment(parent_comment_id, comment, comment_sender_name, grpid)
            VALUES (:parent_comment_id, :comment, $sessname, $currentgroup )";
 $statement = $connect->prepare($query);
 $statement->execute(array( ':parent_comment_id' => $_POST["comment_id"],
                            ':comment'    => $comment_content,
                            ':comment_sender_name' => $sessname,
                            ':groupid'=> $_GET['groupid']));
                            
 $error = '<label class="text-success">Comment Added</label>';
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
