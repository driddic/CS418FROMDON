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
         $commentvalue = '';
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
   <form action= 'add_comment.php' method='POST' id='comment_form' enctype ='multipart/form-data'>
    <div class='form-group'>
    <input type='hidden' name='comment_number' id='comment_number' class='form-control' value= '$commentvalue' />
     <input type='hidden' name='comment_name' id='comment_name' class='form-control' value='$sessname' />
     <input type='hidden' name='comment_id' id='comment_id' class='form-control' value='$sessid' />
     <input type='hidden' name='group_num' id='group_num' class='form-control' value='$currentgroup' />
     <input type='hidden' name='comment_time' id='comment_time' class='form-control' value='$arrivalString' />
    </div>
    <div class='form-group'>
     <textarea name='comment_content' id='comment_content' class='form-control' placeholder='Enter Comment' rows='5'></textarea>
    </div>
    <div class='form-group'>
    <input type='file' name='picupload' id = 'upload' class = 'form-control' value='picupload'>
     <input type='submit' name='submit' value='Submit' />
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
<?php
//           $connect = new PDO('mysql:host=localhost;dbname=university', 'root', '');
//                       // find out the number of results stored in database
//             $sql="SELECT * FROM tbl_comment WHERE grpid = '$currentgroup' ORDER BY comment_id DESC";
//             $result = mysqli_query($connect, $sql);
//             $number_of_results = mysqli_num_rows($result);
//             // determine number of total pages available
//             $number_of_pages = ceil($number_of_results/$results_per_page);
//             // determine which page number visitor is currently on
//             if (!isset($_GET['page'])) {
//               $page = 1;
//             } else {
//               $page = $_GET['page'];
//             }
//             // determine the sql LIMIT starting number for the results on the displaying page
//             $this_page_first_result = ($page-1)*$results_per_page;
//             // retrieve selected results from database and display them on page
//              $sql="SELECT * FROM tbl_comment WHERE grpid = '$currentgroup' ORDER BY comment_id DESC LIMIT ' $this_page_first_result ','$results_per_page'";
//              $result = mysqli_query($con, $sql);
//             while($row = mysqli_fetch_array($result)) {
//               echo '<div class="panel panel-default">
//                         <div class="panel-heading">By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
//                          <div class="panel-body">'.$row["message"].'</div>
//                          <div class="panel-footer" align = "center">
//                          <form action= "add_comment.php" method="POST" id="reply_form">
//                            <input type="text"align="right" name="reply" placeholder="Type reply..." size ="30">
//                            <button type="submit" align ="left "class="btn btn-default reply" id="'.$row["comment_id"].'">Reply</button>
//                            </form>
//                           <button type="button" align ="left" class="btn btn-default reply"id="'.$row["comment_id"].'">CHEER</button>
//                            <button type="button" align="left" class="btn btn-default reply"id="'.$row["comment_id"].'">BOO</button></div>
//
//                         </div>';
//             }
//             // display the links to the pages
//             for ($page=1;$page<=$number_of_pages;$page++) {
//               echo '<a href="homepage.php?groupid='.$currentgroup.'?page=' . $page . '">' . $page . '</a> ';
//             }
//           //sort by groups
//           //$query = "SELECT * FROM tbl_comment WHERE grpid = '$currentgroup' ORDER BY comment_id DESC";
//
//           $statement = $connect->prepare($sql);
//           $statement->execute();
//           //
//
//           //gathering results from $query to sort the feed/design
//           $result = $statement->fetchAll();
//           $output = '';
//           foreach($result as $row){
//
//
//             if ($sessid == 9) {
//               $sumthing = $row["uid"];
//               $sqlmg =" SELECT * FROM profileimage WHERE userid = '$sumthing' ";
//               $resultmg = mysqli_query($conn, $sqlmg);
//               while ($rowmg = mysqli_fetch_assoc($resultmg)){
//
//
//                   if ($rowmg['status'] == 0) { //put a class on it
//                           // echo "<img src = 'assets/profile".$sessid.".jpg' class='avatar'>";
//                           // echo "<img src = 'assets/profile".$sessid.".png'class='avatar'>";
//                 $output .= '<div class="panel panel-default">
//                            <div class="panel-heading">
//                            <img src = "assets/profile'.$sumthing.'.jpg" class="avatar">
//                            <img src = "assets/profile'.$sumthing.'.png" class="avatar">
//                            </div>
//                            <div class="panel-heading">By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
//                            <div class="panel-body">'.$row["message"].'</div>
//                            <div class="panel-footer" align = "center">
//                            <form action= "add_comment.php" method="POST" id="reply_form">
//                              <input type="text"align="right" name="reply" placeholder="Type reply..." size ="30">
//                              <button type="submit" align ="left "class="btn btn-default reply" id="'.$row["comment_id"].'">Reply</button>
//                              </form>
//
//                              <button type="button" align ="left" class="btn btn-default reply"id="'.$row["comment_id"].'">CHEER</button>
//                              <button type="button" align="left" class="btn btn-default reply"id="'.$row["comment_id"].'">BOO</button></div>
//                              <form action= "setting.php" method="POST" id="admindelete">
//                               <input type = "hidden" name="commid" id ="commid" value="'.$row["comment_id"].'"/>
//                                <button type="submit" name ="delete" align ="left "class="btn btn-default reply" id="'.$row["comment_id"].'">Delete</button>
//                                </form>
//                           </div>';
//                   }else {
//                     // echo "<img src = 'assets/profile.png' class='avatar'>";
//
//                 $output .= '<div class="panel panel-default">
//                              <div class="panel-heading">
//                              <img src = "assets/profile.png" class="avatar">
//                              </div>
//                              <div class="panel-heading">By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
//                              <div class="panel-body">'.$row["message"].'</div>
//                              <div class="panel-footer" align = "center">
//                              <form action= "add_comment.php" method="POST" id="reply_form">
//                                <input type="text"align="right" name="reply" placeholder="Type reply..." size ="30">
//                                <button type="submit" align ="left "class="btn btn-default reply" id="'.$row["comment_id"].'">Reply</button>
//                                </form>
//
//                                <button type="button" align ="left" class="btn btn-default reply"id="'.$row["comment_id"].'">CHEER</button>
//                                <button type="button" align="left" class="btn btn-default reply"id="'.$row["comment_id"].'">BOO</button></div>
//                                <form action= "setting.php" method="POST" id="admindelete">
//                                 <input type = "hidden" name="commid" id ="commid" value="'.$row["comment_id"].'"/>
//                                  <button type="submit" name ="delete" align ="left "class="btn btn-default reply" id="'.$row["comment_id"].'">Delete</button>
//                                  </form>
//                             </div>';
//                   }}
//
//               if($row["parent_comment_id"] == 0)
//               {
//                $marginleft = 0;
//               }
//               else
//               {
//                $marginleft = $marginleft + 66;
//               }
//              //displaying output
//              echo $output;
//            }
//             else {
//               $sumthing = $row["uid"];
//
//               $sqlmg =" SELECT * FROM profileimage WHERE userid = '$sumthing' ";
//               $resultmg = mysqli_query($conn, $sqlmg);
//               while ($rowmg = mysqli_fetch_assoc($resultmg)){
//
//
//                   if ($rowmg['status'] == 0) { //put a class on it
//                           // echo "<img src = 'assets/profile".$sessid.".jpg' class='avatar'>";
//                           // echo "<img src = 'assets/profile".$sessid.".png'class='avatar'>";
//                 $output .= '<div class="panel panel-default">
//                            <div class="panel-heading">
//                            <img src = "assets/profile'.$sessid.'.jpg" class="avatar">
//                            <img src = "assets/profile'.$sessid.'.png" class="avatar">
//                            </div>
//                            <div class="panel-heading">By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
//                            <div class="panel-body">'.$row["message"].'</div>
//                            <div class="panel-footer" align = "center">
//                            <form action= "add_comment.php" method="POST" id="reply_form">
//                              <input type="text"align="right" name="reply" placeholder="Type reply..." size ="30">
//                              <button type="submit" align ="left "class="btn btn-default reply" id="'.$row["comment_id"].'">Reply</button>
//                              </form>
//
//                              <button type="button" align ="left" class="btn btn-default reply"id="'.$row["comment_id"].'">CHEER</button>
//                              <button type="button" align="left" class="btn btn-default reply"id="'.$row["comment_id"].'">BOO</button></div>
//
//                           </div>';
//                   }else {
//                     // echo "<img src = 'assets/profile.png' class='avatar'>";
//
//                 $output .= '<div class="panel panel-default">
//                              <div class="panel-heading">
//                              <img src = "assets/profile.png" class="avatar">
//                              </div>
//                              <div class="panel-heading">By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
//                              <div class="panel-body">'.$row["message"].'</div>
//                              <div class="panel-footer" align = "center">
//                              <form action= "add_comment.php" method="POST" id="reply_form">
//                                <input type="text"align="right" name="reply" placeholder="Type reply..." size ="30">
//                                <button type="submit" align ="left "class="btn btn-default reply" id="'.$row["comment_id"].'">Reply</button>
//                                </form>
//
//                                <button type="button" align ="left" class="btn btn-default reply"id="'.$row["comment_id"].'">CHEER</button>
//                                <button type="button" align="left" class="btn btn-default reply"id="'.$row["comment_id"].'">BOO</button></div>
//
//                             </div>';
//                   }}
//
//
//
//
//               if($row["parent_comment_id"] == 0)
//               {
//                $marginleft = 0;
//               }
//               else
//               {
//                $marginleft = $marginleft + 66;
//               }
//              //displaying output
//              echo $output;
//            }
//          }//end of foreach
// //     echo '<div class="pagination">
// //   <a href="#">&laquo;</a>
// //   <a class="active" href="#">1</a>
// //   <a href="#">2</a>
// //   <a href="#">3</a>
// //   <a href="#">4</a>
// //   <a href="#">5</a>
// //   <a href="#">6</a>
// //   <a href="#">&raquo;</a>
// // </div>'; ?>
