<?php
      //Messenger Page
      //start php code
      session_start();
      date_default_timezone_set("America/New_York");
      require 'testconn.php';
      include 'header.php';
      //initialize variables

      $arrival = new DateTime();
      $arrivalString = $arrival->format("Y-m-d H:i:s");
      $direct=$_GET["treadid"];
      $sessname = $_SESSION['username'];
      $sessid= $_SESSION['userid'];
      $commentvalue = '';

?>
      <!-- //with this file you will see how I grabbed info from the search bar to
      //allow the user to direct message another user..

      //I plan to make another table in the bd to -->
      <div id= "bigbox">
        <div align=center>
          <h1>Messages</h1>
          <?php
          echo "Direct Messages";
          ?>
          <br>
          <br>
          <?php
          //interesting query
          $dmq = "SELECT distinct threadID
                  FROM (messageroom Inner join users on messageroom.recip = users.userid
                  OR messageroom.sender = users.userid)
                  WHERE users.userid = '$sessid'";


          $dmconn = mysqli_query($conn, $dmq);
          if(mysqli_num_rows($dmconn) > 0){
             // if one or more rows are returned do following
          while ($results = mysqli_fetch_assoc($dmconn)){

          echo "<div>
               <a href='messages.php?treadid=".$results["threadID"]."'name ='".$results["threadID"]."'class='w3-bar-item w3-button'>  ".$results["threadID"]."</a>
                 </div>";
              }
            }
          if (!$direct) {
            echo "Which chat would you like ?";
          }
          elseif ($direct) {

            $reach = "SELECT * FROM (messageroom INNER JOIN users on messageroom.sender = users.userid) WHERE threadID = $direct ORDER BY timestamp ASC ";
            $reaching = mysqli_query($conn, $reach);

            if (mysqli_num_rows($reaching) > 0) {
              while ($toot = mysqli_fetch_array($reaching)) {
              echo '<div class="panel panel-default">
                 <div class="panel-heading"></div>
                 <div class="panel-heading">By <b>'.$toot["uname"].'</b> on <i>'.$toot["timestamp"].'</i></div>
                 <div class="panel-body">'.$toot["message"].'</div>
                 <div class="panel-footer" align = "center">
                 </div>';
                 $receive = $toot["sender"];
              }
              // echo $receive;
            echo "
            <div class='container'>
             <form action= 'postmessages.php' method='POST' id='comment_form'>
              <div class='form-group'>
              <input type='hidden' name='comment_number' id='comment_number' class='form-control' value= '$commentvalue' />
               <input type='hidden' name='comment_name' id='comment_name' class='form-control' value='$sessid' />
               <input type='hidden' name='comment_rec' id='comment_rec' class='form-control' value='$receive' />
               <input type='hidden' name='thread_num' id='thread_num' class='form-control' value='$direct' />
               <input type='hidden' name='comment_time' id='comment_time' class='form-control' value='$arrivalString' />
              </div>
              <div class='form-group'>
               <textarea name='comment_content' id='comment_content' class='form-control' placeholder='Enter Comment' rows='5'></textarea>
              </div>
              <div class='form-group'>
               <input type='submit' name='reply' value='Reply' />
              </div>
             </form>
             <span id='comment_message'></span>
             <br />
             <div id='display_comment'></div>
            </div>";
            }

          }

            else {
              echo "No group exist";
            }






           ?>
      </div>
      <div align=center>
        <h1>New Message</h1>

<?php
      if (isset($_POST['submit'])) {
        //this is where based off what account the user
        //has selected to message the account selected
        //information will be filled in automatically

        //postmessages will be used to input info into the
        //database
        $coolid = $_POST['searchedid'];
        $name = $_POST['searchedname'];
        $sessid= $_SESSION['userid'];

        echo "New message to ".$name. ""  .$coolid;

        echo"<form action='postmessages.php' method = 'post'>
        <textarea name='message_content' id='message_content' class='form-control' placeholder='Say Whats Up' rows='5'></textarea>
        <div class='form-group'>
        <input type= 'hidden' name='recip' value= ".$coolid.">
        <input type= 'hidden' name= 'sender' value = ".$sessid.">
        <input type='submit' name='send' value='Send' />
       </div>
       </form>";

      }

      //create a place to send a message to any user

?>
  </div>
