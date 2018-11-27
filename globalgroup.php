<?php
//session_start();
include 'testconn.php';
require_once 'postmessages.php';
include_once 'homepage.php';

$sessname = $_SESSION['username'];
$sessid= $_SESSION['userid'];
$comment = "";
$commenterror = "";
$arrival = new DateTime();
$arrivalString = $arrival->format("Y-m-d H:i:s");
// $nameofgroup = $results["grpname"];
$currentgroup= $_GET['groupid'];

// echo $currentgroup;
// echo $nameofgroup;
if (!$currentgroup) {
  echo "Hello Pick a Group";
}

elseif ($currentgroup) {

  // echo $sessname;

  echo "<form method='POST' action='".setComments($conn)."'>
    <input type='hidden' name='userid' value='".$sessid."'>
    <input type='hidden' name='timestamp' value='".date('Y-m-d H:i:s')."'>
    <input type='hidden' name='username' value='".$sessname."'>
     <textarea name='comment' rows='5' cols='80' placeholder='Whats the play?....'></textarea>
     <p><span class='error'>$commenterror</span></p>
      <button align = center type='submit' name='commentsSubmit' value='Submit'>Post</button>
  </form>
  ";
  // messages shown
  $chat= "SELECT * FROM messageroom WHERE grpid = '$currentgroup' ORDER BY timestamp DESC";
  $room = mysqli_query($conn, $chat);
  if(mysqli_num_rows($room) > 0){ // if one or more rows are returned do following
      while($chatroom = mysqli_fetch_array($room)){

         echo "<div><p>Post says: ".$chatroom['message']."</p>
                    <p> at: ".$chatroom['timestamp']." by: ".$chatroom['uname']."</p>
                    <button id ='reply'>Reply</button></div>

                       <div id = myreplysection>
                       <form method='POST' action='".setComments($conn)."'>
                         <input type='hidden' name='userid' value='".$sessid."'>
                         <input type='hidden' name='timestamp' value='".date('Y-m-d H:i:s')."'>
                         <input type='hidden' name='username' value='".$sessname."'>
                         <textarea name='comment' rows='1' cols='45' class='w3-bar-item w3-input w3-white'></textarea>
                         <p><span class='error'>$commenterror</span></p>
                         <button type='submit' name='commentsSubmit' value='Submit' class= 'w3-bar-item w3-button w3-grey w3-mobile'>Post</button>
                       </form>
                       </div>";
        }
    }
}
else {
  echo "page find error";
}

 ?>

<script type="text/javascript">
      $(document).ready(function(){

        $("#reply").click(function(){
            $("div").show();
        });
      });
</script>
