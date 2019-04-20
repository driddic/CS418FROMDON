<?php
//fetch_comment.php
include 'testconn.php';

$group = $_GET['groupajax'];

$query = " SELECT * FROM tbl_comment
            WHERE parent_comment_id = '0' and grpid = '$group'
            ORDER BY comment_id DESC ";
$sabbath = mysqli_query($conn, $query);
$number_of_results = mysqli_num_rows($sabbath);
$results_per_page = 10;
// determine number of total pages available
$number_of_pages = ceil($number_of_results/$results_per_page);
// determine which page number visitor is currently on
if (!isset($_GET['page'])) {
  $page = 1;
} else {
  $page = $_GET['page'];
}
// determine the sql LIMIT starting number for the results on the displaying page
$this_page_first_result = ($page-1)*$results_per_page;
// retrieve selected results from database and display them on page
 $sqlone="SELECT * FROM tbl_comment WHERE grpid = 6 ORDER BY comment_id DESC LIMIT ".$this_page_first_result.",".$results_per_page."";
 $result = mysqli_query($conn, $sqlone);


$output = '';
while ($row = mysqli_fetch_assoc($sabbath)) {

 $output .= '
 <div class="panel panel-default">
  <div class="panel-heading">By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
  <div class="panel-body">'.$row["message"].'</div>
  <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Reply</button></div>
 </div>
 ';
 $output .= get_reply_comment($conn,$row["comment_id"]);
}
echo $output;
// display the links to the pages

  function get_reply_comment($conn, $parent_id = 0, $marginleft = 0){
    $group = $_GET['groupajax'];
  $query = " SELECT * FROM tbl_comment
              WHERE parent_comment_id = '$parent_id'
              and grpid= '$group' ";
   $output = '';
   $sabbathsec = mysqli_query($conn, $query);
   $count= mysqli_num_rows($sabbathsec);
   $marginleft = $marginleft + 48;
   if($count > 0) {
     while ($row = mysqli_fetch_assoc($sabbathsec)) {
     $output .= '
     <div class="panel panel-default" style="margin-left:'.$marginleft.'px">
      <div class="panel-heading">By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
      <div class="panel-body">'.$row["message"].'</div>
      <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Reply</button></div>
     </div>
     ';
     $output .= get_reply_comment($conn, $row["comment_id"], $marginleft);
    }
   } return $output;
  }
//   exit();
// }
?>
