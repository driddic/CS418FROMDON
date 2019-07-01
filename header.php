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

    // if(!isset($_SESSION['username']) && !isset($_SESSION['githubUser']))
    //   {
    //     header('Location: ./index.php?error=loginfirsthdr');
    //   }
    //           if(isset($_SESSION['githubUser']))
    //           {
    //             require "init.php";
    //             $loginWebService = new LoginWebService();
    //             $githubUser = fetchData();
    //             $githubEmail = $githubUser['email']['email'];
    //             $githubUsername = $githubUser['username'];
    //             $userExists = $loginWebService->checkIfUserExistsByEmail($githubEmail);
    //             if($userExists == true)
    //             {
    //               //fetch existing user
    //               if(!isset($_SESSION)){
    //                 session_start();
    //               }
    //               $_SESSION['UserId'] = $loginWebService->getUserIdFromUserEmail($githubEmail);
    //               $githubUserInfo = $loginWebService->getUserInfo($_SESSION['UserId']);
    //               $githubUserInfo = json_decode($githubUserInfo, true);
    //                  $_SESSION['UserId'] = $githubUserInfo['userInfo'][0]['ID'];
    //                  $_SESSION['FirstName'] = $githubUserInfo['userInfo'][0]['FirstName'];
    //                  $_SESSION['LastName'] = $githubUserInfo['userInfo'][0]['LastName'];
    //                  $_SESSION['Email'] = $githubUserInfo['userInfo'][0]['Email'];
    //                  $_SESSION['ProfilePictureLoggedIn'] = "https://avatars.githubusercontent.com/". $githubUsername;
    //                  $_SESSION['Password'] = $githubUserInfo['userInfo'][0]['Password'];
    //
    //                  $_SESSION['UserName']=$githubUserInfo['userInfo'][0]['UserName'];
    //                  $_SESSION['userType'] = $githubUserInfo['userInfo'][0]['type'];
    //                  $_SESSION['ProfilePicture'] = "https://avatars.githubusercontent.com/" . $githubUserInfo['userInfo'][0]['UserName'];
    //                  $_SESSION['displayPic'] = $githubUserInfo['userInfo'][0]['displayPic'];
    //                  //$loginWebService->updateDisplayPic($_SESSION['UserId'], 0);
    //                  //$loginWebService->uploadProfilePicture($_SESSION['UserId'], $_SESSION['ProfilePicture']);
    //                  unset ($_SESSION["githubUser"]);
    //             }
    //             else
    //             {
    //               $loginWebService->insertNewUser($githubUsername, "", $githubUsername, $githubEmail, "", "");
    //               if(!isset($_SESSION)){
    //                 session_start();
    //               }
    //                $_SESSION['UserId'] = $loginWebService->getUserIdFromUserEmail($githubEmail);
    //                $githubUserInfo = $loginWebService->getUserInfo($_SESSION['UserId']);
    //                $githubUserInfo = json_decode($githubUserInfo, true);
    //                $_SESSION['UserId'] = $githubUserInfo['userInfo'][0]['ID'];
    //                $_SESSION['FirstName'] = $githubUserInfo['userInfo'][0]['FirstName'];
    //                $_SESSION['LastName'] = $githubUserInfo['userInfo'][0]['LastName'];
    //                $_SESSION['Email'] = $githubUserInfo['userInfo'][0]['Email'];
    //                $_SESSION['ProfilePictureLoggedIn'] = $githubUserInfo['userInfo'][0]['ProfilePicture'];
    //                $_SESSION['Password'] = $githubUserInfo['userInfo'][0]['Password'];
    //                $_SESSION['UserName']=$githubUserInfo['userInfo'][0]['UserName'];
    //                $_SESSION['userType'] = $githubUserInfo['userInfo'][0]['type'];
    //                $_SESSION['ProfilePicture'] = "https://avatars.githubusercontent.com/" . $githubUserInfo['userInfo'][0]['UserName'];
    //                $_SESSION['displayPic'] = $githubUserInfo['userInfo'][0]['displayPic'];
    //                $loginWebService->addUserToGroup(3, $githubUserInfo['userInfo'][0]['ID']);
    //                $loginWebService->updateDisplayPic($_SESSION['UserId'], 0);
    //                $loginWebService->uploadProfilePicture($_SESSION['UserId'], $_SESSION['ProfilePicture']);
    //                unset ($_SESSION["githubUser"]);
    //             }
    //           }

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

<?php


//  if (!isset($_SESSION['username']))
// {
//   echo "not logged in";
//   header("Location: index.php?error=loginfirsthdr");
//   exit();
// }

// function get_photo($conn){
// $sessname= $_SESSION['username'];
// $sessid= $_SESSION['userid'];
// $sqlone = "SELECT * FROM users WHERE uname = '".$sessname."' ";
// $result = mysqli_query($conn, $sqlone);
//
//  if(mysqli_num_rows($result) > 0){
//
//      while ($results = mysqli_fetch_assoc($result)){
//        //would be sessname
//        $sqlImg =" SELECT * FROM profileimage WHERE userid = '$sessid' ";
//        $resultImg = mysqli_query($conn, $sqlImg);
//        while ($rowImg = mysqli_fetch_assoc($resultImg)){
//
//                if ($rowImg['status'] == 0) {
//                  echo "<img src = 'assets/profile".$sessid.".jpg' width= '90' height= '50'>";
//                  echo "<img src = 'assets/profile".$sessid.".png' width= '90' height= '50'>";
//                }else {
//                  echo "<img src = 'assets/profile.png' width= '70' height= '60'>";
//                }
// }}}}

?>
</body>
</html>
