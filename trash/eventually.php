<?php

include 'testconn.php';

function setComments($conn)
{

  if (isset($_POST['commentsSubmit'])) {

    $date = $_POST['timestamp'];
    $comment =$_POST['comment'];
    $uid=$_SESSION['userid'];
    $sql = " INSERT INTO messageroom (message, timestamp, userid, grpid) VALUES ('$comment','$date','$uid', ?????)";
    $rack = mysqli_query($conn, $sql);
  }
}

function fetchComments($conn)
//global group messages shown
$chat= "SELECT * FROM messageroom WHERE grpid = ????? ORDER BY timestamp DESC";
$room = mysqli_query($conn, $chat);
if(mysqli_num_rows($room) > 0){ // if one or more rows are returned do following
    while($chatroom = mysqli_fetch_array($room)){
      echo "<div><p>Post says: <h3>".$chatroom['message']."</h3></p>
                <p> at: ".$chatroom['timestamp']." by: ".$chatroom['userid']."</p>

      </div>";
    }
  }

?>
<div id = "container" class="">
  <p id = "group-one"><?php echo "hi group1"; ?></p>
  <p id = "group-two"><?php echo "hi group2"; ?></p>
  <p id = "group-three"><?php echo "hi group3"; ?></p>
  <p id = "group-four"><?php echo "hi group4"; ?></p>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>

<script type="text/javascript">
  $(document).ready(function){

  }
</script>
