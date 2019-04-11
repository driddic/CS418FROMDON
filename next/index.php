<?php
//index.php
session_start();
include 'testconn.php';

?>
<!DOCTYPE html>
<html>
 <head>
  <title>Comment System using PHP and Ajax</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 </head>
 <body>
  <br />
   <?php
   $sessname = $_SESSION['username'];
   $sessid= $_SESSION['userid'];
  $currentgroup= 6;
  $comment = "";
  $commenterror = "";
  $commentvalue = '';
  $arrival = new DateTime();
  $arrivalString = $arrival->format("Y-m-d H:i:s");
  //$currentgroup= $_GET['groupid'];
  $results_by_page = 7;
 //Testing
  // echo $currentgroup;
  // echo $nameofgroup;
  if (!$currentgroup) {
    echo "<h1>Hello, Pick a Group</h1>";
  }

  elseif ($currentgroup) {

    echo "
    <div class='container'>
     <form action= 'add_comment.php' method='POST' id='comment_form'>
      <div class='form-group'>
      <input type='hidden' name='comment_number' id='comment_number' class='form-control' value= '$commentvalue' />
       <input type='hidden' name='comment_name' id='comment_name' class='form-control' value='@peach' />
       <input type='hidden' name='comment_id' id='comment_id' class='form-control' value='6' />
       <input type='hidden' name='group_num' id='group_num' class='form-control' value='$currentgroup' />
       <input type='hidden' name='comment_time' id='comment_time' class='form-control' value='$arrivalString' />
      </div>
      <div class='form-group'>
       <input name='comment_content' id='comment_content' class='form-control' placeholder='Enter Comment' rows='5'></textarea>
      </div>
      <div class='form-group'>
       <input type='submit' name='submit' value='Submit' />
      </div>
     </form>
     <span id='comment_message'></span>
     <br />
     <div id='display_comment'></div>
    </div>";
}
  else {
    echo "No Page!";
  }
   ?>
 </body>
</html>

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
   success:function(data)
   {
    if(data.error != '')
    {
     $('#comment_form')[0].reset();
     $('#comment_message').html(data.error);
     $('#comment_id').val('0');
     load_comment();
    }
   }
  })
 });

 load_comment();

 function load_comment()
 {
  $.ajax({
   url:"fetch_comment.php",
   method:"POST",
   success:function(data)
   {
    $('#display_comment').html(data);
   }
  })
 }

 $(document).on('click', '.reply', function(){
  var comment_id = $(this).attr("id");
  $('#comment_id').val(comment_id);
  $('#comment_content').focus();
 });

});
</script>
