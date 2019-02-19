<!DOCTYPE HTML>
<html>
<head><style>.error {color: #FF0000;}</style>
</head>
<body>
 <?php

      //start php code
      session_start();
      date_default_timezone_set("America/New_York");
      require 'testconn.php';

      include 'postmessages.php';
      //initializ variables
      $comment = "";
      $commenterror = "";
      $arrival = new DateTime();
      $arrivalString = $arrival->format("Y-m-d H:i:s");

      //include_once 'homepage.php';


      //something fancy
      if ($_SERVER["REQUEST_METHOD"] == "POST")
      {

        //on form button click
        if (isset($_POST['commentsSubmit'])) {

          if (empty($_POST["comment"])) {//if field is empty post error message
            $commenterror = "Comment is required";
            header("location: homepage.php?error=noinput");
            exit();
          }

          else {  //initialize and run function test input
            $comment = test_input($_POST["comment"]);
              }
            }
        }



  ?>
  <!--form-->
  <?php
   {

    echo "hello this is group number". $grpclick;

    //on screen

    // echo "<div><p><b>New post:<b> ".$comment."</p>
    //           <p> at: ".$arrivalString." by: ".$sessname."</p>
    //
    // </div>";


  }


  echo "<form method='POST' action='".setComments($conn)."'>
    <input type='hidden' name='user' value='".$_SESSION['userid']."'>
    <input type='hidden' name='timestamp' value='".date('Y-m-d H:i:s')."'>
    <input type='hidden' name='group' value='".$_GET['groupid']."'>
     <textarea name='comment' rows='5' cols='80'></textarea>
     <p><span class='error'>$commenterror</span></p>
      <button align = center type='submit' name='commentsSubmit' value='Submit'>Post</button>
  </form>
  ";
  ?>


<?php
if (isset($_POST['commentsSubmit'])) {

  //on screen

  // echo "<div><p><b>New post:<b> ".$comment."</p>
  //           <p> at: ".$arrivalString." by: ".$sessname."</p>
  //
  // </div>";


}
//from db
$chat= "SELECT * FROM messageroom ORDER BY timestamp DESC";
$room = mysqli_query($conn, $chat);
if(mysqli_num_rows($room) > 0){ // if one or more rows are returned do following
    while($chatroom = mysqli_fetch_array($room)){
      echo "<div><p>Post says: ".$chatroom['message']."</p>
                <p> at: ".$chatroom['timestamp']." by: ".$chatroom['uname']."</p>
                <a href= # name = reply> Reply</a>

      </div>";
    }
  }
?>

</body>
</html>
