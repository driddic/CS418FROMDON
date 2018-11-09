<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset ($_POST['submit']))
{
                  $servername = 'localhost';
                  $user = 'admin';
                  $password='monarchs';
                  $db= 'university';
                  $conn = mysqli_connect("localhost","root","","university") OR die("Server Connection error");
                  mysqli_select_db($conn,"university") OR die("DB error");


                  //Check connection
                  if (!$conn) {
                    header("Location: index.php?error=noconn");
                    exit();
                  } else{
                      echo "Connected";
                  }

//check this out from the video
$uname = $_POST['username'];
$password = $_POST['password'];

if (empty($uname) || empty($password)) {  //error handling for emtypy fields
  header("Location: index.php?error=emptyfields");
 exit();

}

else {    // if we can result database against empty fields
          $sql = "SELECT * FROM users WHERE uname='".$uname."' and pword= '".$password."'";
          $result = mysqli_query($conn,$sql);

          if (mysqli_fetch_assoc($result))
          {
                      //if true start a session here
                    //session_start();
                    $_SESSION['uname'] = $uname;

                    //$_SESSION['logged_in']= true;
                    header("Location: homepage.php");
                    exit();

          }
          else { //incase of a mistake , safe case
                  Header("Location: index.php?error=noacct");
                  exit();

                }

      }

}
else {
  echo "SOMETHING HAPPENED WRONG";
}

                        //change this part

                      //  $pwdCheck = password_verify($password, $row['pword']);

                        // if($pwdCheck == false){
                        //   header("Location: index.php?error=wrongpwd");
                        //   exit();}
                        //
                        //     elseif ($pwdCheck == true) {


          // else {
          //   header("Location: index.php?error=noacct");
          //           exit();
          //         }





          //echo "1.2";
          // $stmt = mysqli_stmt_init($conn);
          //   if (!mysqli_stmt_prepare($stmt, $sql)) {
          //   header("Location: index.php?error=sqlerror");
          //   exit();
          //  echo "1.3";

            // else { //purpose is in 1:27:00
            // mysqli_stmt_bind_param($stmt,"s", $uname, $uname);
            // mysqli_stmt_execute($stmt);
            // $result = mysqli_stmt_get_result($stmt);

                    //checking if there is a hit
