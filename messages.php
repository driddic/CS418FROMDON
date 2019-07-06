<style media="screen">
.container {
border: 2px solid #dedede;
background-color: #f1f1f1;
border-radius: 5px;
padding: 10px;
margin: 10px 0;
}
.container::after {
  content: "";
  clear: both;
  display: table;
}
.form-group textarea{
  border-radius: 15px;
  border: 2px solid lightblue;
  padding: 20px;
  width: 700px;
  height: 150px;
}
.form-group input{
  border-radius: 15px;
  border: 2px solid lightblue;
  width: 80px;
  height: 50px;
  position: relative;
}
/* Style tab links */
.tablink {
  background-color: #555;
  color: white;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  font-size: 17px;
  width: 25%;
}

.tablink:hover {
  background-color: #777;
}

/* Style the tab content (and add height:100% for full page content) */
.tabcontent {
  color: white;
  display: none;
  padding: 100px 20px;
  height: 100%;
}
</style>

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
          $dmq = "SELECT Distinct * FROM messagecontrol WHERE userOne = '$sessname' or userTwo = '$sessname'";
          $dmconn = mysqli_query($conn, $dmq);
          if(mysqli_num_rows($dmconn) > 0){
             // if one or more rows are returned do following
          while ($results = mysqli_fetch_assoc($dmconn)){

            if ($results["userOne"] == $sessname) {
              // <button class="tablink" onclick="openPage('Home', this, 'red')">Home</button>
              echo "<div>
                   <a href='messages.php?treadid=".$results["threadId"]."'name ='".$results["threadId"]."'class='w3-bar-item w3-button'>  ".$results["userTwo"]."</a>
                     </div>";
            }elseif ($results["userTwo"] == $sessname) {

              echo "<div>
                     <a href='messages.php?treadid=".$results["threadId"]."'name ='".$results["threadId"]."'class='w3-bar-item w3-button'>  ".$results["userOne"]."</a>
                       </div>";
               }else {
                 echo "What threads exists?";
               }

              }
            }

            //Seperate
            //Selcting the threadID
          if (!$direct) {
            echo "Which chat would you like ?";
          }
          elseif ($direct) {
            //I can make this query better
            $reach = "SELECT * FROM messageroom WHERE threadID = $direct ORDER BY timestamp ASC ";
            $reaching = mysqli_query($conn, $reach);

            if (mysqli_num_rows($reaching) > 0) {
              while ($toot = mysqli_fetch_array($reaching)) {
              echo '<div class="container">
                       <div><b>'.$toot["fromUser"].'</b> </div>
                       <div>'.$toot["message"].'</div>
                       <div><i>'.$toot["timestamp"].'</i></div>
                 </div>';

                 //has to change
                 // $receive = $toot["toUser"];
                 // $receiveID = $toot["recip"];

              }
            }

            echo "
            <div class='container-type'>
             <form action= 'postmessages.php' method='POST' id='comment_form'>
              <div class='form-group'>
              <input type='hidden' name='comment_number' id='comment_number' class='form-control' value= '$commentvalue' />
               <input type='hidden' name='comment_send_id' id='comment_send_id' class='form-control' value='$sessid' />
               <input type='hidden' name='comment_send' id='comment_send' class='form-control' value='$sessname' />
               <input type='hidden' name='thread_num' id='thread_num' class='form-control' value='$direct' />
               <input type='hidden' name='comment_time' id='comment_time' class='form-control' value='$arrivalString' />
              </div>
              <div class='form-group'>
               <textarea name='comment_content' id='comment_content' class='form-control' placeholder='Enter Message' rows='1'></textarea>
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

            else {
              echo "No group exist";
            }






           ?>
      </div>
      <div align=center>

<?php
      if (isset($_POST['submit'])) {
        echo "<h1>New Message</h1>";
        //this is where based off what account the user
        //has selected to message the account selected
        //information will be filled in automatically

        //postmessages will be used to input info into the
        //database
        $coolid = $_POST['searchedid'];
        $name = $_POST['searchedname'];
        $sessid= $_SESSION['userid'];
        $sessname = $_SESSION['username'];

        echo "New message to ".$name. ""  .$coolid;

        echo"<form action='postmessages.php' method = 'post'>
        <textarea name='message_content' id='message_content' class='form-control' placeholder='Say Whats Up' rows='5'></textarea>
        <div class='form-group'>
        <input type= 'hidden' name='recipID' value= ".$coolid.">
        <input type= 'hidden' name= 'senderID' value = ".$sessid.">
        <input type= 'hidden' name= 'sender' value = ".$sessname.">
        <input type= 'hidden' name= 'recip' value = ".$name.">

        <input type='submit' name='send' value='Send' />
       </div>
       </form>";

      }

      //create a place to send a message to any user

?>
  </div>
  <script>
  function openPage(pageName,elmnt,color) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].style.backgroundColor = "";
    }
    document.getElementById(pageName).style.display = "block";
    elmnt.style.backgroundColor = color;
  }

  // Get the element with id="defaultOpen" and click on it
  document.getElementById("defaultOpen").click();
  </script>
