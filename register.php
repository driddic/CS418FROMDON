<?php
session_start();


include_once 'testconn.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset ($_POST['su-submit']))
{


                  $uname = $_POST['username'];
                  $pwd = $_POST['password'];
                  $pwdagain = $_POST['password-rep'];
                  $email = $_POST['Email'];
                  $fname = $_POST['firstname'];
                  $lname = $_POST['lastname'];


                          if (empty($uname) || empty($pwd) ||empty($email) || empty($fname) || empty($lname)) {  //error handling for emtypy fields
                            header("Location: signup.php?error=emptyfields");
                            echo "h1";
                           exit();
                         }

                          elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                                   header("Location: signup.php?error=bademail");
                                   echo "h2";
                                  exit();
                                 }

                                 elseif ($pwd !== $pwdagain) {
                                   header("Location: signup.php?error=badpwdmatch");
                                   echo "h3";
                                   exit();
                                 }

                                 elseif($pwd==$pwdagain){    // if we can result database against empty fields
                           //is the input user name on the database already
                                $sql = " SELECT * FROM users WHERE uname ='".$uname."'; ";
                                $result = mysqli_query($conn,$sql);

                                if(mysqli_num_rows($result) > 0) {
                                   header("Location: signup.php?error=usertaken");
                                   echo "h4";

                                   exit();
                                 }
                                      }


                    $sqltwo= " INSERT INTO users (fname,lname,uname,email,pword )VALUES ('".$fname."', '".$lname."', '".$uname."', '".$email."', '".$pwd."'); ";
                    $score = mysqli_query($conn, $sqltwo);
                    Header("location: index.php?signup=good");

                    exit();



}
    mysqli_close($conn);
