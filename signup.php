<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset ($_POST['submit'])){
  $servername = 'localhost';
  $user = 'admin';
  $password='';
  $db= 'university';
    $conn =   mysqli_connect("localhost","root","","university") OR die("Server Connection error");
      mysqli_select_db($conn,"university") OR die("DB error");


  // $servername = 'localhost';
  // $user = 'admin';
  // $password='';
  // $db= 'university';
  // //establish connection
  // $conn = mysqli_connect($servername,$user,$password,$db);

  //Check connection
  if (!$conn) {
    header("Location: index.php?error=noconn");
    exit();
  } else{
      echo "Connected";
    // header("Location: index.php?error=emptyfields");
    // exit();
  }

//check this out from the video
$uname = $_POST['username'];
$password = $_POST['password'];

if (empty($uname) || empty($password)) {  //error handling for emtypy fields
  header("Location: index.php?error=emptyfields");
  exit();
  echo "1.1";
}

else {
          $sql = "SELECT * FROM users WHERE uname='".$uname."'";  // if we can result database against empty fields
          //echo "1.2";
          $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: index.php?error=sqlerror");
            exit();
          //  echo "1.3";
            }
//Problem Child
            else { //purpose is in 1:27:00
            mysqli_stmt_bind_param($stmt,"s", $uname, $uname);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

                    //checking if there is a hit
                      if ($row = mysqli_fetch_assoc($result))
                      {
                                    //checking password, do passwords match

                                    $pwdCheck = password_verify($password, $row['pword']);

                                    if($pwdCheck == false){
                                      header("Location: index.php?error=wrongpwd");
                                      exit();}

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
  header("Location: homepage.php");
}
