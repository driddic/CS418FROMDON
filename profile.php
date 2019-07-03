<!DOCTYPE html>
<?php session_start(); ?>
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

    <style media="screen">
    .avatar {
    vertical-align: middle;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    }

    #help{
      height: 500px;
      width: 1000px;
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
             <a href="logout.php" style = "float:right" id = "logout" class="w3-bar-item w3-button w3-mobile">Logout</a>
             <!-- Live Search -->
             <form style="float:right" action="search.php" method="POST" >
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


    require 'testconn.php';
    //include 'header.php';
    $sessname= $_SESSION['username'];
    $sessid= $_SESSION['userid'];
    $pickid= $_GET['uid'];

    //this query is to count how many posts an user has made.
    $sql= "SELECT count(comment_id) FROM tbl_comment
               WHERE uid = '".$pickid."'" ;
               $acResults=mysqli_query($conn,$sql);
               $find = mysqli_fetch_assoc($acResults);
               $rep = $find['count(comment_id)'];
               //may need and
?>

<div id = "bigbox">
<?php
//What to display if the the logged in user is the same as the user profile being viewed
if ($sessid == $pickid) {

  $sqlone = "SELECT * FROM users WHERE userid = '".$sessid."' ";
  $result = mysqli_query($conn, $sqlone);

  if(mysqli_num_rows($result) > 0){
      while ($results = mysqli_fetch_assoc($result)){
        $sqlImg =" SELECT * FROM profileimage WHERE userid = '$sessid' ";
        $resultImg = mysqli_query($conn, $sqlImg);
        while ($rowImg = mysqli_fetch_assoc($resultImg)){
          echo "<h2 style='text-align:center'>User Profile</h2>
                <div>";
            if ($rowImg['status'] == 0) {
              //gravatar code
              if ($rowImg['keep'] == 0) {
              //if user elects to keep the gravatar as default
              //show the gravatar
              $email = $results["email"];

              $default = $rowImg['locate'];
              $size = 180;
             $grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
                    echo "<img src='$grav_url' alt='gravatar' />";
              }else {
                // code...
                echo "<img src = '".$rowImg['locate']."' width = '700' height = '700'>";
                    // echo "<img src = 'assets/profile".$sessid.".jpg'>";
                    // echo "<img src = 'assets/profile".$sessid.".png'>";
                  }
            //else (no image has been uploaded or gravatar option has not been selected)
            }else {
              if ($rowImg['keep'] == 1) {
                echo "<img class = avatar src = 'assets/profile.png'>";

              }else {
                echo "<img class = avatar src = 'assets/profile.png'>";
                // code...
              }
            }
          }
            //reputation model formula votes, posts and groups
            //posts
            $sqlfive= "SELECT count(comment_id) FROM tbl_comment
                       WHERE comment_sender_name = '".$sessname."'" ;
            $actResults=mysqli_query($conn,$sqlfive);
            $find = mysqli_fetch_assoc($actResults);

            // echo "this is find: ".print_r($find);
            // echo "<br>";
            //groups
            $grp = "SELECT COUNT(grpid) FROM `membership`
                    WHERE uname = '".$sessname."' and active = '0'";
            $howMany = mysqli_query($conn,$grp);
            $grab = mysqli_fetch_array($howMany);
            // echo "this is grab: ";
            // print_r($grab);
            // echo "<br>";

            //votes
            $vote = "SELECT COUNT(id) FROM `voter` WHERE userid = '".$sessid."'";
            $thisMany = mysqli_query($conn, $vote);
            $get = mysqli_fetch_row($thisMany);

            // echo "this is get: ".print_r($get);
            // echo "<br>";
            //echo the name of user out
            echo "<h1>".$results['fname']." ".$results['lname']." </h1>";
            //Now, the average
            $collection = ($thisMany+$actResults+$howMany / 3) ;

            echo "<p> Activity: ".$collection." Rating </p>";
            if ($collection <= 5){echo "Rookie";}
            elseif ($collection <=20 || $collection >= 6 ) {echo "Star";}
            elseif ($collection <=50 || $collection >=21) {echo "All-Star";}
            elseif($collection >=51) {
              echo "Hall of Fame";
            }else {
              echo "No rank";
            }
            echo"<form action='upload.php' method='POST' enctype='multipart/form-data'>
            <p> Select image to upload for ". $_SESSION['username']."</p>
            <input type='file' name='picupload' >
            <input type='submit' name='upload' value='Upload Picture'>
            </form>
            </div>";

        ?>
        <div class="" align = "center">

        <form action="upload.php" method="post">
          <p>Would you like to have your gravatar as your default profile image?</p>
          <input type="radio" name="option" value="yes" checked>Yes!
          <input type="radio" name="option" value="no">No
          <input type="hidden" name="name" value="<?php echo $sessid; ?>">
          <input type="submit" name="gravpick" value="Submit">
        </form>

      </div>
        <?php
            }}
        else {
          echo "no users found";
        }

}else {
//what the page should display if you view another users profile page

  $sql= "SELECT count(comment_id) FROM tbl_comment
             WHERE uid = '".$pickid."'" ;
  $acResults=mysqli_query($conn,$sql);
  $find = mysqli_fetch_assoc($acResults);

  $sqlone = "SELECT * FROM users WHERE userid = '".$pickid."' ";
  $theresult = mysqli_query($conn, $sqlone);
  if(mysqli_num_rows($theresult) > 0){
      while ($results = mysqli_fetch_assoc($theresult)){
        $sqlmg =" SELECT * FROM profileimage WHERE userid = '$pickid' ";
        $resultmg = mysqli_query($conn, $sqlmg);
        while ($rowmg = mysqli_fetch_assoc($resultmg)){
          echo "<h2 style='text-align:center'>User Profile</h2>
                <div>";

            if ($rowmg['status'] == 0) { //put a class on it
                    echo "<img src = '".$rowmg['locate']."' width = '700' height = '700'>";
                    // echo "<img src = 'assets/profile".$pickid.".png'>";

            }else {
              echo "<img src = 'assets/profile.png'>";
            }}

  echo "<h1>".$results['fname']." ".$results['lname']." </h1>";

  echo "<p> Activity: ".$find['count(comment_id)']." Posts </p>";
  if ($rep <= 5){echo "Rookie";}
  elseif ($rep <=20 || $rep >= 6 ) {echo "Star";}
  elseif ($rep <=50 || $rep >=21) {echo "All-Star";}
  elseif($rep >=51) {echo "Hall of Fame";}
  else {
    echo "no rank";
  }

  echo "  <form action ='messages.php' method= 'post'>
          <input type = 'hidden' name= 'searchedname' id = 'searchedname' value = ".$results['uname'].">
          <input type = 'hidden' name= 'searchedid' id = 'searchedid' value = ".$results['userid'].">
          <input type = 'Submit' name = 'submit' value= 'Message'>
        </form>
  </div>";
}}
}

      ?>


      </div>
  </body>
</html>
