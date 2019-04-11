<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo $_SESSION['username'];?> | goODU</title>
    <?php
    include 'testconn.php';
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL); ?>

    <script src="./assets/index.js"></script>
    <!-- <script>
      $(document).ready(function(){
        $("#search").keyup(function(){
          $("#here").show();
          var x = $(this).val();
          $.ajax(
            {
                type:'GET',
                url:'search.php',
                data:'query='+x;
                success:function(data)
                {
                  $("#here").html(data);
                }

            });
        });
      });

    </script> -->
    <style media="screen">
    .avatar {
    vertical-align: middle;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    }
    </style>
    <link rel="stylesheet" type="text/css" href="./assets/index.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script>
function showResult(str) {
  if (str.length==0) {
    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
    return;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("livesearch").innerHTML=this.responseText;
      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET","livesearch.php?q="+str,true);
  xmlhttp.send();
}
</script>
  </head>
  <body>

     <header>
       <div id="container">
         <div class="w3-bar w3-light-grey w3-border w3-padding" >
             <a href="homepage.php" class="w3-bar-item w3-button w3-mobile">Home</a>
             <?php
             $sessid= $_SESSION['userid'];
              echo "<a href='profile.php?uid=".$sessid."' class='w3-bar-item w3-button w3-mobile'>Profile</a>
                 ";?>
             <a href="group.php" class="w3-bar-item w3-button w3-mobile">Groups</a>
             <a href="messages.php" class="w3-bar-item w3-button w3-mobile">Messenger</a>
             <a href="help.php" class="w3-bar-item w3-button w3-mobile">Help</a>
             <a href="logout.php" style = "float:right" type = "logout" name = "logout"
             class="w3-bar-item w3-button w3-mobile">Logout</a>
             <!-- Live Search -->
             <form align="right" style="float:right" action="search.php" method="POST" >
             <input type="text" class="w3-bar-item w3-input w3-white"
              placeholder="Search Users.." size = "70" onkeyup="showResult(this.value)">
             <!-- <button type="submit" class="w3-bar-item w3-button w3-grey w3-mobile" >goODU</button> -->
             <div id="livesearch"></div>
             </form>
        </div>
       </div>
     </header>

<?php


 if (!isset($_SESSION['username']))
{
  echo "not logged in";
  header("Location: index.php?error=loginfirsthdr");
  exit();
}



function get_reply_comment($conn, $parent_id = 1, $marginleft = 0){

     $currentgroup= $_GET['groupid'];
     //connecting to db and sql query statement execution
     $query = "SELECT * FROM tbl_comment WHERE grpid = '".$currentgroup."'";
     // echo $query;
     $output = '';
     $statement = mysqli_query($conn, $query);
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
function get_photo($conn){
$sessname= $_SESSION['username'];
$sessid= $_SESSION['userid'];
$sqlone = "SELECT * FROM users WHERE uname = '".$sessname."' ";
$result = mysqli_query($conn, $sqlone);

 if(mysqli_num_rows($result) > 0){

     while ($results = mysqli_fetch_assoc($result)){
       //would be sessname
       $sqlImg =" SELECT * FROM profileimage WHERE userid = '$sessid' ";
       $resultImg = mysqli_query($conn, $sqlImg);
       while ($rowImg = mysqli_fetch_assoc($resultImg)){

               if ($rowImg['status'] == 0) {
                 echo "<img src = 'assets/profile".$sessid.".jpg' width= '90' height= '50'>";
                 echo "<img src = 'assets/profile".$sessid.".png' width= '90' height= '50'>";
               }else {
                 echo "<img src = 'assets/profile.png' width= '70' height= '60'>";
               }
}}}}

?>
</body>
</html>
