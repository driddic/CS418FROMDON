<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset ($_POST['su-submit']))
{
                  $servername = 'localhost';
                  $user = 'admin';
                  $password='monarchs';
                  $db= 'University';
                  $conn = mysqli_connect("localhost","admin","monarchs","University") OR die("Server Connection error");
                  mysqli_select_db($conn,"university") OR die("DB error");


                  //Check connection
                  if (!$conn) {
                    header("Location: index.php?error=noconn");
                    exit();
                  } else{
                      echo "Connected";
                  }

$uname = $_POST['username'];
$password = $_POST['password'];
$passwordagain =$_POST['password-rep'];
$email = $_POST['Email'];
$fname =$_POST['firstname'];
$lname =$_POST['lastname'];

if (empty($uname) || empty($password) ||empty($email) || empty($fname) || empty($lname)) {  //error handling for emtypy fields
  header("Location: signup.php?error=emptyfields");
  echo "h1";
 exit();

}

elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {

  header("Location: signup.php?error=bademail");
  echo "h2";
 exit();
}

elseif ($password !== $passwordagain) {
  header("Location: signup.php?error=badpwdmatch");
  echo "h3";
  exit();
}

else {    // if we can result database against empty fields

   $sql = "SELECT * FROM users WHERE uname ='".$uname."'";
           // $result = mysqli_query($conn,$sql);
          if (mysqli_num_rows($sql) > 0) {

            header("Location: signup.php?error=usertaken");
            echo "h4";
            exit();
          }

          else {
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT)
            mysqli_query("INSERT INTO users (fname, lname, uname, email, pword) VALUES ('".$fname."', '".$lname."', '".$uname."', '".$email."', '".$hashedPwd."')");
            header("location: index.php?succes=signup");
            echo "h5";
            exit();
          }

        }

mysqli_close($conn);

         }

else {
          header("Location: signup.php?error=noclick");
          exit();
        }

        //  if (!mysqli_fetch_assoc($result)) {
        //    header("Location: signup.php?error=sqlerror1");
        //    exit();
        //  }
        //
        // else {
        //   mysqli_stmt_bind_param($stmt, "s", $uname);
        //   mysqli_stmt_execute($stmt);
        //   mysqli_stmt_store_result($stmt);
        //   $resultCheck = mysql_stmt_num_rows($stmt);
        //
        //   if ($resultCheck > 0) {
        //     header("Location: signup.php?error=usertaken");
        //    exit();

         //  else {
         //       $sql = "INSERT INTO users (id, email, pword, fname, lname) VALUES (?, ?, ?, ?, ?)";
         //       $result = mysqli_query($conn,$sql);
         //       if (!mysqli_fetch_assoc($result))  {
         //         header("Location: signup.php?error=sqlerror2");
         //         exit();
         //
         //       }
         //
         // else{
         //   $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
         //
         //   mysqli_stmt_bind_param($stmt, "sss", $uname, $email, $hashedPwd,$fname,$lname);
         //   mysqli_stmt_execute($stmt);
         // //  just fetching mysqli_stmt_store_result($stmt);
         //  header("Location: signup.php?signup=success");
         //  exit();
         // }



        // if (mysqli_fetch_assoc($result))
        // {
        //             //if true start a session here
        //           //session_start();
        //           $_SESSION['uname'] = $uname;
        //
        //           //$_SESSION['logged_in']= true;
        //           header("Location: homepage.php");
        //           exit();
        //
        // }
        // else { //incase of a mistake , safe case
        //         Header("Location: index.php?error=noacct");
        //         exit();
        //
        //       }

        // else {
        //   echo "SOMETHING HAPPENED WRONG";
        // }

                                //change this part

                              //  $pwdCheck = password_verify($password, $row['pword']);

                                // if($pwdCheck == false){
                                //   header("Location: index.php?error=wrongpwd");
                                //   exit();}
                                //
                                //     elseif ($pwdCheck == true) {

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
