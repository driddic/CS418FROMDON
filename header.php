<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo $_SESSION['username'];?> | goODU</title>
    <?php
    include 'testconn.php';
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    ?>

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
    .notification {
            background-color: #555;
            color: white;
            text-decoration: none;
            padding: 15px 26px;
            position: relative;
            display: inline-block;
            border-radius: 2px;
}

.notification:hover {
  background: red;
}

 /* .w3-bar-itemw3-buttonw3-mobile .badge span{
  position: absolute;
  top: -10px;
  right: -10px;
  padding: 5px 10px;
  border-radius: 50%;
  background: red;
  color: white;
} */
    </style>
    <link rel="stylesheet" type="text/css" href="./assets/index.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">


    <script>
function showResultUser(str) {
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
              placeholder="Search Users.." size = "70" onkeyup="showResultUser(this.value)">
             <!--  <button type="submit" class="w3-bar-item w3-button w3-grey w3-mobile" >goODU</button> -->
             <div id="livesearch"></div>
             </form>
        </div>
       </div>
     </header>
</body>
</html>
