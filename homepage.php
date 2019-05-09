<?php
    session_start();
    require_once 'testconn.php';
    include 'header.php';
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>homepage</title>

    <!--
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      <!--
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    -->
     <style media="screen">
           .avatar {
           vertical-align: middle;
           width: 50px;
           height: 50px;
           border-radius: 50%;
           }
           /* The Modal (background) */
           .modal {
             display: none; /* Hidden by default */
             position: fixed; /* Stay in place */
             z-index: 1; /* Sit on top */
             padding-top: 100px; /* Location of the box */
             left: 0;
             top: 0;
             width: 100%; /* Full width */
             height: 100%; /* Full height */
             overflow: auto; /* Enable scroll if needed */
             background-color: rgb(0,0,0); /* Fallback color */
             background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
           }
           /* Modal Content */
           .modal-content {
             background-color: #fefefe;
             margin: auto;
             padding: 20px;
             border: 1px solid #888;
             width: 80%;
           }
           code, samp, kbd {
             font-family: "Courier New", Courier, monospace, sans-serif;
             text-align: left;
             color: #555;
             }
           .image_upload > form > input
           {
               display: none;
             }
           .image_upload img
           {
               width: 24px;
               cursor: pointer;
           }
           .code_upload img
           {
               width: 24px;
               cursor: pointer;
           }
           .slider.round {
             border-radius: 34px;
           }

           .slider.round:before {
             border-radius: 50%;
           }
           .switch {
             position: relative;
             display: inline-block;
             width: 60px;
             height: 34px;
           }

           .switch input {
             opacity: 0;
             width: 0;
             height: 0;
           }

           .slider {
             position: absolute;
             cursor: pointer;
             top: 0;
             left: 0;
             right: 0;
             bottom: 0;
             background-color: #ccc;
             -webkit-transition: .4s;
             transition: .4s;
           }

           .slider:before {
             position: absolute;
             content: "";
             height: 26px;
             width: 26px;
             left: 4px;
             bottom: 4px;
             background-color: white;
             -webkit-transition: .4s;
             transition: .4s;
           }

           input:checked + .slider {
             background-color: #2196F3;
           }

           input:focus + .slider {
             box-shadow: 0 0 1px #2196F3;
           }

           input:checked + .slider:before {
             -webkit-transform: translateX(26px);
             -ms-transform: translateX(26px);
             transform: translateX(26px);
           }
           .box {
           width:600px;
           margin:0 auto;
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
         <form class="" action="homepage.php" method="post">
           <input type="text" name="opensearch" placeholder="OpenSearch for all posts">
             <input type="submit" name="opens" value="Search">
           </form>

      <!-- //listing groups the user is in -->
      <h4>Groups</h4>

      <?php
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
               $groupTitle = $results["grpname"];
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
         //how i did openesearch
         if (isset($_POST["opens"])) {
          $search = $_POST["opensearch"];
          $search = htmlspecialchars($search);
          $search = mysqli_real_escape_string($conn, $search);
          $raw_results = mysqli_query($conn,"SELECT * FROM tbl_comment WHERE MATCH(message) Against('$search')") or die(mysqli_error($conn));
          if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following
            echo "<div id = 'bigbox'>
                   <h1 align = center> Search Results</h1>";
                   while($results = mysqli_fetch_array($raw_results)){
                echo'  <div class="panel panel-default">
                      <div class="panel-heading">By <b>'.$results["comment_sender_name"].'</b> on <i>'.$results["date"].'</i></div>
                      <div class="panel-body">'.$results["message"].'</div>
                      <div class="panel-footer" align="right">
                      <button type="button" class="btn btn-default reply" id="'.$results["grpid"].'">'.$results["grpid"].'</button>
                      </div>
                     </div>';
            }
            echo "</div>";
          }
        }//end of open search stuff
        if (!$currentgroup) {
          echo "pick a group fam";
        }else if($currentgroup) {
          //Enter Comment HERE
          ?>

  <div class='container'>
  <form id='comment_form' class="w3-form-post" enctype="multipart/form-data" >
   <div class="form-group">
     <textarea name='comment_content' id='comment_content' class='form-control' placeholder='Enter Comment' rows='5' required>
     </textarea>
   </div>
    <div class="form-group">
     <input type="hidden" name='comment_name' id='comment_name' class='form-control' value='<?php echo $sessname?>' >
     <input type="hidden" name='user_id' id='user_id' class='form-control' value='<?php echo $sessid?>' >
     <input type="hidden" name="group_num" id='group_num' class='form-control' value='<?php echo $currentgroup?>' >
     <input type="hidden" name="comment_time" id='comment_time' class='form-control' value='<?php echo $arrivalString?>' >
     <div class="form-group" align="left">
      Code: <input type="checkbox" name="code_upload" value="1">
     </div>
     <input type="hidden" name="comment_id" id="comment_id" class='form-control' value='<?php echo $commentvalue ?>' >
     <input type='submit' name='submit' id='submit'   value='Post'>
     </div>
   </form>
   <!-- Trigger/Open The Modal -->
     <button id="myBtn">Post Pictures Using URL</button>
    <!-- The Modal -->
    <div id="myModal" class="modal">
     <!-- Modal content -->
     <div class="modal-content">
       <span class="close">&times;</span>
       <div class="container box">

       <div class="form-group">
         <label>Enter Image Url</label>
         <input type="hidden" name="mygroup" value="<?php echo $currentgroup; ?>">
         <input type="text" name="image_url" id="image_url" class="form-control" />
       </div>
       <div class="form-group">
         <input type="button" name="upload" id="upload" value="Upload" class="btn btn-info" />
       </div>
   <br />
   <div id="result"><img src = "#" class="img-thumbnail img-responsive" /></div>
  </div>
</div>
  <div style="clear:both"></div>

  <script type="text/javascript">

$(document).ready(function(){
$('#upload').click(function(){
//
var groupid = $('#mygroup').val();
var image_url = $('#image_url').val();
if(image_url == '')
{
 alert("Please enter image url");
 return false;
}
else
{
 $('#upload').attr("disabled", "disabled");
 $.ajax({
  url:"upload.php",
  method:"POST",
  data:{image_url:image_url,
        groupid:<?php echo $currentgroup; ?>},
  dataType:"JSON",
  beforeSend:function(){
   $('#upload').val("Processing...");
  },
  success:function(data)
  {
   $('#image_url').val('');
   $('#upload').val('Upload');
   $('#upload').attr("disabled", false);
   $('#result').html(data.image);
   alert(data.message);
  }
 })
}
});
});

  </script>
     </div>


   <!-- Trigger/Open The Modal -->
    <button id="myBtntwo">Post Pictures</button>
    <!-- The Modal -->
    <div id="myModaltwo" class="modal">
     <!-- Modal content -->
     <div class="modal-content">
       <span class="closetwo">&times;</span>
       <p>Select a file to post</p>
       <!-- <form class="w3-form-post" >
         <input id="whatpic" type="file" name="see" required>
        <input id="postUpload" type="submit" name="postUpload" value="Post">
        <img id="blah" src="#" alt="#" width="200" height="200">
       </form> -->
     <div class="container" style="width:700px;">

   <label>Select Image </label>

   <input type="hidden" name="grouppic" id="grouppic" value=" <?php $currentgroup;?>">
   <input type="file" name="file" id="file" />



   <br />
   <span id="uploaded_image"></span>
   <form class="" action="post.php" method="post">
   <input type="hidden" name="grouppic" id="grouppic" value=" <?php $currentgroup;?>">
   <!-- <button class="closetwo" type="submit" name="button">Done</button> -->
 </form>

 </div>
 </div>

<script type="text/javascript">

$(document).ready(function(){
 $(document).on('change', '#file', function(){
  var name = document.getElementById("file").files[0].name;
  var form_data = new FormData();
  form_data.append('grouppic',<?php echo $currentgroup;  ?>);
  var ext = name.split('.').pop().toLowerCase();
   // var grouppic = $('#grouppic').val();
  if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1)
  {
   alert("Invalid Image File");
  }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("file").files[0]);
  var f = document.getElementById("file").files[0];
  var fsize = f.size||f.fileSize;
  if(fsize > 2000000)
  {
   alert("Image File Size is very big");
  }
  else
  {
   form_data.append("file", document.getElementById('file').files[0]);
   //form_data.append("grouppic", document.getElementById('grouppic'));
   $.ajax({
    url:"post.php",
    method:"POST",
    data:form_data,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend:function(){
     $('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
    },
    success:function(data)
    {
     $('#uploaded_image').html(data);
     alert("you won").html("<p>Bye</p>");
    }
   });
  }
 });
});
</script>
    </div>
    </div>
   <span id='comment_message'></span>
   <br>

   <div class="table-responsive" id="pagination_data"></div>

 </div>
</div>
<!-- </div> -->
    <?php
  } else {
    echo "No group exist";
    }
  ?>
  </body>
</html>
<script>

$(document).ready(function(){
  $("#message").empty();
  $('#loading').show();
 $('#comment_form').on('submit', function(event){
  event.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
   url:"add_comment.php",
   method:"POST",
   data:form_data,
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
 function load_comment(page)
 { $.ajax({
   url:"fetch_comment.php",
   method:"POST",
   data:{groupajax: <?php echo $currentgroup ?>,
         page:page},
    success:function(data){
  //  $('#display_comment').html(data);
    $('#pagination_data').html(data);
   }
  })
 }
 $(document).on('click', '.pagination_link', function(){
      var page = $(this).attr("id");
      // load_data(page);
      load_comment(page);
 });
 $(document).on('click', '.reply', function(){
  var comment_id = $(this).attr("id");
  $('#comment_id').val(comment_id);
  $('#comment_content').focus();
 });
 $('#uploadFile').on('change', function(){
  $('#uploadImage').ajaxSubmit({
   target: "#comment_content",
   resetForm: true
  });
 });
});
// Get the modal
var modal = document.getElementById('myModal');
var Modaltwo = document.getElementById('myModaltwo');
// Get the button that opens the modal
var btn = document.getElementById("myBtn");
var btnTwo = document.getElementById("myBtntwo");


// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
var spanTwo = document.getElementsByClassName("closetwo")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}
btnTwo.onclick = function() {
  Modaltwo.style.display = "block";
}
// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}
spanTwo.onclick = function() {
  Modaltwo.style.display = "none";
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
window.onclick = function(event) {
  if (event.target == Modaltwo) {
    Modaltwo.style.display = "none";
  }
}
</script>
