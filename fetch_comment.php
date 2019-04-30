<?php
//fetch_comment.php
include 'testconn.php';
session_start();
$sessid=$_SESSION['userid'];
$sessname=$_SESSION['username'];
$group = $_POST['groupajax'];

$results_per_page = 10;

$page = '';
$output = '';
// determine which page number visitor is currently on

if (isset($_POST["page"])) {
  $page = $_POST["page"];
} else {
  $page = 1;
}
// determine the sql LIMIT starting number for the results on the displaying page
$this_page_first_result = ($page-1)*$results_per_page;
// retrieve selected results from database and display them on page
$sqlone="SELECT * FROM tbl_comment
WHERE parent_comment_id = '0' and grpid = '$group'
ORDER BY comment_id DESC LIMIT ".$this_page_first_result.",".$results_per_page."";
$result = mysqli_query($conn, $sqlone);
$output = '';
$page_query = "SELECT * FROM tbl_comment WHERE grpid = '$group' ORDER BY comment_id DESC";
$page_result = mysqli_query($conn, $page_query);
$total_records = mysqli_num_rows($page_result);
$total_pages = ceil($total_records/$results_per_page);
for($i=1; $i<=$total_pages; $i++)
{
  $output .= '<span class="pagination_link" style="cursor:pointer; padding:6px; border:1px solid #ccc;" id="'.$i.'">'.$i.'</span>';
}
// <img class= "avatar" src = "assets/profile'.$row["uid"].'.png">
while ($row = mysqli_fetch_assoc($result)) {
  if (empty($row['image'])) {
       $output .= '
     <div class="panel panel-default">
      <div class="panel-heading">
      By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
      <div class="panel-body">'.$row["message"].'</div>
      <div class="panel-footer" align="right">
      <button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Reply</button>
       <form action = "add_vote.php" method = "post">
       <input type="hidden" name="comment_name" id="comment_name" class="form-control" value="'. $sessname.'" />
       <input type="hidden" name="user_id" id="user_id" class="form-control" value="'. $sessid.'" />
       '.$row["voteup"].'
      <button type="submit" class="btn btn-default reply" name = "up" value="'.$row["comment_id"].'">UP</button>
      <button type="submit" class="btn btn-default reply" name = "down" value="'.$row["comment_id"].'">DOWN</button>
    '.$row["votedown"].'
      </form>
      </div>
     </div>
     ';
  }else {
// <img class= "avatar" src = "assets/profile'.$row["uid"].'.png">
 $output .= '
 <div class="panel panel-default">
  <div class="panel-heading">
  By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
  <div class="panel-body"><img src = "images/'.$row["image"].'"></div>
  <div class="panel-body">'.$row["message"].'</div>
  <div class="panel-footer" align="right">
  <button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Reply</button>
   <form action = "add_vote.php" method = "post">
   <input type="hidden" name="comment_name" id="comment_name" class="form-control" value="'. $sessname.'" />
   <input type="hidden" name="user_id" id="user_id" class="form-control" value="'. $sessid.'" />
   '.$row["voteup"].'
  <button type="submit" class="btn btn-default reply" name = "up" value="'.$row["comment_id"].'">UP</button>
  <button type="submit" class="btn btn-default reply" name = "down" value="'.$row["comment_id"].'">DOWN</button>
'.$row["votedown"].'
  </form>
  </div>
 </div>
 ';
}
 $output .= get_reply_comment($conn,$row["comment_id"]);

}

echo $output;
// display the links to the pages




  function get_reply_comment($conn, $parent_id = 0, $marginleft = 0){
    $sessid=$_SESSION['userid'];
    $sessname=$_SESSION['username'];
    $group = $_POST['groupajax'];
  $query = " SELECT * FROM tbl_comment
              WHERE parent_comment_id = '$parent_id'
              and grpid= '$group' ";
   $output = '';
   $sabbathsec = mysqli_query($conn, $query);
   $count= mysqli_num_rows($sabbathsec);
   $marginleft = $marginleft + 48;
   if($count > 0) {
     // <img class= "avatar" src = "assets/profile'.$row["uid"].'.png">
     while ($row = mysqli_fetch_assoc($sabbathsec)) {
     $output .= '
     <div class="panel panel-default" style="margin-left:'.$marginleft.'px">
      <div class="panel-heading">By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
      <div class="panel-body">'.$row["message"].'</div>
      <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Reply</button></div>
      <form action = "add_vote.php" method = "post">
      <input type="hidden" name="comment_name" id="comment_name" class="form-control" value="'. $sessname.'" />
      <input type="hidden" name="user_id" id="user_id" class="form-control" value="'. $sessid.'" />
      '.$row["voteup"].'
     <button type="submit" class="btn btn-default reply" name = "up" value="'.$row["comment_id"].'">UP</button>
     <button type="submit" class="btn btn-default reply" name = "down" value="'.$row["comment_id"].'">DOWN</button>
   '.$row["votedown"].'
     </form>
     </div>
     ';
     $output .= get_reply_comment($conn, $row["comment_id"], $marginleft);
    }
   }
   return $output;
  }

//   exit();
// }
?>
