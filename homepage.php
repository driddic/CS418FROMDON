<?php
    session_start();
    require_once 'testconn.php';
    include 'header.php';

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

?>
<main>
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <style media="screen">
    .avatar {
    vertical-align: middle;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    }
    </style>
  </head>
<body>
    <!-- SIDEBAR -->
    <div id= "sidebar" class="w3-sidebar s3 w3-dark-blue w3-bar-block" style= "width:15%">
      <h3 class ="w3-bar-item">
         <?php
         $sessname = $_SESSION['username'];
         $sessid= $_SESSION['userid'];
         $adminNum = '9';
          //check to see if user is logged in first
         if (isset($_SESSION['username'])){echo "Hello  " . $sessname." #".$sessid; }
            else { echo "not logged in";
                  header("Location: index.php?error=loginfirsthp");  }
           ?>
         </h3>
    <?php
      //listing groups the user is in
      echo "Groups";

      if ($sessid == $adminNum) {
            $seegroup = "SELECT grpname, grpid FROM groups ";
            $show = mysqli_query($conn, $seegroup);
            if(mysqli_num_rows($show) > 0){
               // if one or more rows are returned do following
            while ($results = mysqli_fetch_assoc($show)){
            echo "<div>
                 <a href='homepage.php?groupid=".$results["grpid"]."'name ='".$results["grpname"]."'class='w3-bar-item w3-button'>  ".$results["grpname"]."</a>
                   </div>";
                }
              }
      }elseif($sessid !== $adminNum) {
        $sql = "SELECT groups.grpname, groups.grpid
                FROM (( membership INNER JOIN users on membership.userid = users.userid)
                INNER JOIN groups on membership.grpid = groups.grpid)
                WHERE users.userid = '".$sessid."'
                and membership.active = 0
                and groups.archive = 0;";
    //            echo $sql;
        $show = mysqli_query($conn, $sql);
        if(mysqli_num_rows($show) > 0){
           // if one or more rows are returned do following
        while ($results = mysqli_fetch_assoc($show)){
          echo "<div>
               <a href='homepage.php?groupid=".$results["grpid"]."'name ='".$results["grpname"]."'class='w3-bar-item w3-button'>  ".$results["grpname"]."</a>
               </div>";  // code...

            }
          }

      }
else {
  echo "no code";
}

      ?>
    </div>


    <!-- MESSAGE BOARD -->
    <div style="margin-left:15% ">
     <div id = "groupcontent" class="w3-container w3-grey w3-center">
       <?php
         $comment = "";
         $commenterror = "";
         $commentvalue = "0";
         $arrival = new DateTime();
         $arrivalString = $arrival->format("Y-m-d H:i:s");
         $currentgroup= $_GET['groupid'];
         $results_by_page = 7;

        if (!$currentgroup) {
          echo "pick a group fam";
        }else if($currentgroup) {
          //Enter Comment HERE
  echo "
  <div class='container'>
   <form action= 'add_comment.php' method='POST' id='comment_form'>
    <div class='form-group'>
     <input type='hidden' name='comment_name' id='comment_name' class='form-control' value='$sessname' />
     <input type='hidden' name='user_id' id='user_id' class='form-control' value='$sessid' />
     <input type='hidden' name='group_num' id='group_num' class='form-control' value='$currentgroup' />
     <input type='hidden' name='comment_time' id='comment_time' class='form-control' value='$arrivalString' />
    </div>
    <div class='form-group'>
     <textarea name='comment_content' id='comment_content' class='form-control' placeholder='Enter Comment' rows='5'></textarea>
    </div>
    <div class='form-group'>
    <input type='hidden' name='comment_id' id='comment_id' value='0' />
    <input type='submit' name='submit' value='Submit'/>
    </div>
   </form>
   <span id='comment_message'></span>
   <br />
   <div id='display_comment'></div>
    </div>";
} else {
    echo "No group exist";
  }
   ?>
   </div>
  </body>
</main>
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
  // var altCheck = $(this).find('$currentgroup');
  $.ajax({
   url:"fetch_comment.php",
   method:"GET",
   data:{groupajax: <?php echo $currentgroup ?>},
    //dataType:"JSON",
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
