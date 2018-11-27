<?php
session_start();
include 'testconn.php';
include_once 'postmessages.php';
include_once 'homepage.php';

$sessname = $_SESSION['username'];
$sessid= $_SESSION['userid'];
$comment = "";
$commenterror = "";
$arrival = new DateTime();
$arrivalString = $arrival->format("Y-m-d H:i:s");

$currentgroup= $_GET['groupid'];

echo $currentgroup;
if ($currentgroup) {

  echo "<form method='POST' action='".setComments($conn)."'>
    <input type='hidden' name='user' value='".$_SESSION['userid']."'>
    <input type='hidden' name='timestamp' value='".date('Y-m-d H:i:s')."'>

     <textarea name='comment' rows='5' cols='80'></textarea>
     <p><span class='error'>$commenterror</span></p>
      <button align = center type='submit' name='commentsSubmit' value='Submit'>Post</button>
  </form>
  ";
  //global group messages shown
  $chat= "SELECT * FROM messageroom WHERE grpid = '$currentgroup' ORDER BY timestamp DESC";
  $room = mysqli_query($conn, $chat);
  if(mysqli_num_rows($room) > 0){ // if one or more rows are returned do following
      while($chatroom = mysqli_fetch_array($room)){

        echo "this is that ::";
         echo "<div><p>Post says: ".$chatroom['message']."</p>
                    <p> at: ".$chatroom['timestamp']." by: ".$chatroom['userid']."</p>
                    <button onclick= 'onClickreply()'>Reply</button></div>";
         echo "
                       <div id = myreplysection>
                       <form method='POST' action='".setComments($conn)."'>
                         <input type='hidden' name='user' value='".$_SESSION['userid']."'>
                         <input type='hidden' name='timestamp' value='".date('Y-m-d H:i:s')."'>
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
  function onClickreply() {
    var x = document.getElementById("myreplysection");
    if (x.style.display === "none"){
      x.style.display = "bar";
    }else {
    x.style.display = "none";
    }
  }
</script>
