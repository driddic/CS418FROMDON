<?php

if(isset ($POST['submit'])){
  require 'testconn.php';

//check this out from the video
$uname = $_POST['username'];
$password = $_POST['password'];

if (empty($uname) || empty($password)) {  //error handling for emtypy fields
  header("Location: index.php?error=emtypyfields");
  exit();
}
else {
  $sql = "SELECT * FROM users WHERE uname=? OR email=?;";  // if we can result database against empty fields
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: index.php?error=emtypyfields");
    exit();
  }
  else {
    mysqli_stmt_bind_param($stmt,"s", $uname, $uname);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    //checking if there is a hit
    if ($row = mysqli_fetch_assoc($result)){
      //checking password, do passwords match

      $pwdCheck = password_verify($password, $row['pword']);
      if($pwdCheck == false){
        header("Location: index.php?error=wrongpwd");
        exit();
      }
      elseif ($pwdCheck == true) {
//if true start a session here
      session_start();
      $_SESSION['userID'] = $row['idKey'];
      $_SESSION['username'] = $row['uname'];

      header("Location: index.php?login=success");
      }
      else { //incase of a mistake , safe case
        header("Location: index.php?error=wrongpwd");
        exit();
      }
    }
    else {
      header("Location: index.php?error=noacct");
      exit();
    }
  }
}



}

else {
  header("Location: index.php");
}
