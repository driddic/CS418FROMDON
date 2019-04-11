<?php
session_start();
include 'testconn.php';
//include_once 'homepage.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//initialize variable
$comment = "";
$commenterror = "";
$commentvalue = '';
$arrival = new DateTime();
$arrivalString = $arrival->format("Y-m-d H:i:s");
$currentgroup= $_GET['groupid'];
$sessname = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
 <head>
  <title>Group <?php echo $currentgroup; ?></title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 </head>
 <body>
  <br />

<?php
//eventually i want sportscenter to show up automatically
if (!$currentgroup) {
  echo "<h1>Hello, Pick a Group</h1>";
  //echo "comment value is ".$commentvalue;
}
elseif ($currentgroup){
  echo "
  <div class='container'>
   <form action= 'add_comment.php' method='POST' id='comment_form'>
    <div class='form-group'>
    <input type='hidden' name='comment_number' id='comment_number' class='form-control' value= '$commentvalue' />
     <input type='hidden' name='comment_name' id='comment_name' class='form-control' value='$sessname' />
     <input type='hidden' name='group_num' id='group_num' class='form-control' value='$currentgroup' />
     <input type='hidden' name='comment_time' id='comment_time' class='form-control' value='$arrivalString' />
    </div>
    <div class='form-group'>
     <textarea name='comment_content' id='comment_content' class='form-control' placeholder='Enter Comment' rows='5'></textarea>
    </div>
    <div class='form-group'>
     <input type='submit' name='submit' value='Submit' />
    </div>
   </form>
   <span id='comment_message'></span>
   <br />
   <div id='display_comment'></div>
  </div>";

// fetch_comment code goes here!!!!
//sort by groups
$connect = new PDO('mysql:host=localhost;dbname=university', 'root', '');
$query = "SELECT * FROM tbl_comment WHERE parent_comment_id = '0' AND grpid= '".$currentgroup."' ORDER BY comment_id DESC";
$statement = $connect->prepare($query);
$statement->execute();

function get_reply_comment($connect, $parent_id = 0, $marginleft = 0){
     //connecting to db and sql query statement execution
     $query = "SELECT * FROM tbl_comment WHERE parent_comment_id = '1' and groupid = '.$currentgroup.';";
     $output = '';
     $statement = $connect->prepare($query);
     $statement->execute();
     //gathering results from $query to sort the feed/design
     $result = $statement->fetchAll();
     $count = $statement->rowCount();
     if($parent_id == 0){
      $marginleft = 0;
    }else{
      $marginleft = $marginleft + 48;
     }if($count > 0){
      foreach($result as $row){
       $output .= '<div class="panel panel-default" style="margin-left:'.$marginleft.'px">

        <div class="panel-heading">By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
        <div class="panel-body">'.$row["comment"].'</div>
        <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Reply</button></div>
       </div>';
       $output .= get_reply_comment($connect, $row["comment_id"], $marginleft);
      }
     }
     return $output;
}
//gathering results from $query to sort the feed/design
$result = $statement->fetchAll();
$output = '';
foreach($result as $row){
 $output .= '<div class="panel panel-default">

  <div class="panel-heading">By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
  <div class="panel-body">'.$row["message"].'</div>
  <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Reply</button></div>
 </div>';
 $output .= get_reply_comment($connect, $row["comment_id"]);
}
//displaying output  NEEDED
echo $output;
//grabbing any replies to comments
//if there is no results
  // $result = mysqli_query($conn, $query);
  // while ($results = mysqli_fetch_assoc($result)) {
  //   if (!$results) {
  //     echo "Be the first to leave a message!";
  //   }
  //   else {
  //   $output = '';
  //   $output .= '<div class="panel panel-default">
  //     <div class="panel-heading">By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
  //     <div class="panel-body">'.$row["comment"].'</div>
  //     <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Reply</button></div>
  //    </div>';
  //    $output .= get_reply_comment($connect, $row["comment_id"]);
  //  }
  //   }
}
else{
  echo "page find error";
}
//End of PHP
?>
 </body>

<!--
BEGINNING of <scripts>
-->
</html>
<script type="text/javascript">
      $(document).ready(function(){
        $("#reply").click(function(){
            $("div").show();
        });
      });
</script>

<script>
$(document).ready(function(){
 $('#comment_form').on('submit', function(event){
  event.preventDefault();
  var form_data = $(this).serialize();
      $.ajax({
       url:"add_comment.php",
       method:"POST",
       data:form_data,
       dataType:"JSON",
       success:function(data){
        if(data.error != ''){
         $('#comment_form')[0].reset();
         $('#comment_message').html(data.error);
         $('#comment_id').val('0');
         load_comment();
        }
       }
      })
    });

 load_comment();

 function load_comment(){
  $.ajax({
   url:"next/fetch_comment.php",
   method:"POST",
   success:function(data){
    $('#display_comment').html(data);
   }
 });//added ;
 }

 $(document).on('click', '.reply', function(){
  var comment_id = $(this).attr("id");
  $('#comment_id').val(comment_id);
  $('#comment_name').focus();
 });
});
</script>
