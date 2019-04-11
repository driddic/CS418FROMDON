<?php
//fetch_comment.php
//session_start();
//grabbing any replies to comments

  $connect = new PDO('mysql:host=localhost;dbname=university', 'root', '');
  //sort by groups
  $query = "SELECT * FROM tbl_comment WHERE parent_comment_id = '0' ORDER BY comment_id DESC";
  $statement = $connect->prepare($query);
  $statement->execute();
  //

  //gathering results from $query to sort the feed/design
  $result = $statement->fetchAll();
  $output = '';
  foreach($result as $row){
   $output .= '<div class="panel panel-default">
    <div class="panel-heading">By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
    <div class="panel-body">'.$row["message"].'</div>
    <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Reply</button></div>
   </div>';
   get_reply_comment($connect);
  }
  //displaying output
  echo $output;
  function get_reply_comment($connect, $parent_id = 1, $marginleft = 0){
       //connecting to db and sql query statement execution
       $query = "SELECT * FROM tbl_comment WHERE grpid = '$currentgroup'";

       $output = '';
       $statement = $connect->prepare($query);
       $statement->execute();

       //gathering results from $query to sort the feed/design
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
       if($count > 0){
        foreach($result as $row){
         $output .= '<div class="panel panel-default" style="margin-left:'.$marginleft.'px">
          <div class="panel-heading">By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
          <div class="panel-body">'.$row["message"].'</div>
          <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Reply</button></div>
         </div>';
        // $output .= get_reply_comment($connect, $row["comment_id"], $marginleft);
        }
       }
       return $output;
  }
