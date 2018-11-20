<?php

//fetch_comment.php
require 'testconn.php';

$query = "SELECT * FROM message WHERE parent_commentID = '0' ORDER BY messID DESC";

$statement = $conn->prepare($query);

$statement->execute();
$resultSet = $statement->get_result();
$result = $resultSet->mysqli_fetch_all();

$output = '';
foreach($result as $row)
{
 $output .= '<div class="panel panel-default">
  <div class="panel-heading">By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
  <div class="panel-body">'.$row["comment"].'</div>
  <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Reply</button></div>
 </div>';
 $output .= get_reply_comment($conn, $row["comment_id"]);
}

echo $output;

function get_reply_comment($conn, $parent_id = 0, $marginleft = 0)
{
 $query = "
 SELECT * FROM message WHERE parent_commentID = '".$parent_id."'
 ";
 $output = '';
 $statement = $conn->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $count = $statement->rowCount();
 if($parent_id == 0)
 {
  $marginleft = 0;
 }
 else
 {
  $marginleft = $marginleft + 48;
 }
 if($count > 0)
 {
  foreach($result as $row)
  {
    //display the comment
   $output .= '
   <div class="panel panel-default" style="margin-left:'.$marginleft.'px">
    <div class="panel-heading">By <b>'.$row["userID"].'</b> on <i>'.$row["timestamp"].'</i></div>
    <div class="panel-body">'.$row["text"].'</div>
    <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["messID"].'">Reply</button></div>
   </div>
   ';
   $output .= get_reply_comment($conn, $row["messID"], $marginleft);
  }
 }
 return $output;
}

?>
