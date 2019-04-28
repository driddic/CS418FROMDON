<?php session_start();
//  include 'header.php';
  //include 'testfunction.php';
 ?>
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
?>




    <div id="bigbox">
      <h1><a id="top"></a>Help Page</h1>

      <a href="#chat">Access Group Chats</a>
    <br>  <a href="#dm">Send Direct Messages</a>
    <br> <a href="#pic">Upload/Change Profile Picture</a>
    <br>  <a href="#group">Create a Group</a>
    <br>  <a href="#invite">Invite people to Groups</a>
  <br><a href="#search">Searching Names and Groups</a>
  <br><br>

      <h2><a id="chat"></a>Access Group Chats</h2>
      <p>After Making it through the login page you will find yourself on <br>
      the homepage where you can see the groups you are apart of to the left<br>
    and a message on the right prompting you to select a group. Once you select an <br>
   group the message board of that group will be displayed.</p>
   <img src="assets/groups.jpg" alt="help1" height="500" width="1200">
   <img src="assets/chat.jpg" alt="help1" height="500" width="1200">

   <p>To add a comment to the page you can select the text box that says <br>
   enter comment. Once you have typed your message click submit and refresh the page<br>
  </p>

  <p>To reply to a comment is similar to typing one. Once you click reply you will <br>
    prompted to type in the comment text box. </p>
  <br>
  <a href="#top">Back to top</a>

  <br>
    <h2><a id="dm"></a>Sending Direct Messages</h2>
    <img src="assets/dm.jpg" alt="help1" height="500" width="1200">
    <h3>New Message</h3>
    <p>Step 1: Navigate to the desired users profile page and click 'Message'</p><br>
    <p>Step 2: Type a message and click send</p>
    <img src="assets/dmchat.jpg" alt="help1" height="500" width="1200">
    <h3>Existing Thread</h3>
    <p>Step 1: Click on Messenger</p><br>
    <p>Step 2: Click on desired thread</p><br>
    <p>Step 3: Type a message</p><br>
    <p>Step 4: Send the message</p>
    <a href="#top">Back to top</a>

  <br><br>
  <h2><a id="pic"></a>Upload/Change Profile Picture</h2>
  <img src="assets/pic.jpg" alt="help1" height="500" width="1200">
  <h3>Uploading a Profile Picture</h3>
  <p>Step 1: Click upload</p><br>
  <p>Step 2: Select file and click ok</p><br>
  <p>Step 3: Click Upload Picture</p><br>

  <br><h3>Making Gravatar Default</h3>
  <p>Step 1: Select if you would like to have your gravatar as your default <br>
  by selecting either yes or no</p><br>
  <p>Step 2: Click Submit</p>
  <a href="#top">Back to top</a>

  <br><br>
  <img src="assets/grouppage.jpg" alt="" height="500" width="1200">
  <h2><a id="group"></a>Create a Group</h2>
  <p>Step 1: Go to Groups page</p><br>
  <p>Step 2: Type in the name of the group</p><br>
  <p>Step 3: Select if you would like the group to be public or private</p><br>
  <p>Step 4: CLick Submit</p><br>
  <a href="#top">Back to top</a>

  <h2><a id="invite"></a>Invite Users to Group</h2>
  <img src="assets/invite.jpg" alt="" height="500" width="1200">
  <p>Step 1: Go to Groups page</p><br>
  <p>Step 2: Select a group under 'My Groups'</p><br>
  <p>Step 3: Select a user </p><br>
  <p>Step 4: Click Invite</p><br>

  <h2>Accepting a Invitation to a Group</h2>
  <p>Your new group invite will be located in the Notifications section<br>
  of the Groups page. You can accept the invite there.</p><br>
  <a href="#top">Back to top</a>

  <h2><a id="search"></a>Search a Group</h2>
  <img src="assets/grpsearch.jpg" alt="" height="500" width="1200">
  <p>Step 1: Go to Group page</p><br>
  <p>Step 2: type a phrase or name of the group</p><br>
  <p>Step 3: Click Search</p><br>
  <p>Note: If the group if public you will have the option to join.</p><br>
  <br>
  <h2>Search a User</h2>
  <img src="assets/search.jpg" alt="" height="50" width="1200">
  <p>On the naviagation bar on the very top of the page <br>
  type in the name of a user. The live search will help you find an user.</p>

  <a href="#top">Back to top</a>

    </div>
  </body>
</html>
