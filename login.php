<?php
session_start();
include_once 'testconn.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset ($_POST['submit']))
{


//check this out from the video
            $uname = $_POST['username'];
            $pwd = $_POST['password'];

            if (empty($uname) || empty($pwd)) {  //error handling for emtypy fields
              header("Location: index.php?error=emptyfields");
             exit();

            }

            else {


                    // if we can result database against empty fields
                      $sql = "SELECT * FROM users WHERE uname='".$uname."' and pword= '".$pwd."';";
                      $result = mysqli_query($conn, $sql);

                      if (mysqli_fetch_assoc($result))
                      {
                                  //if true start a session here
                                //session_start();
                                $_SESSION['userid'] = $userid;
                                $_SESSION['uname'] = $uname;
                                $_SESSION['password'] = $pwd;

                                //$_SESSION['logged_in']= true;
                                header("Location: homepage.php");
                                exit();


                                // Change this portion
                      }
                      else { //incase of a mistake , safe case
                              Header("Location: index.php?error=noacct");
                              exit();

                            }

                  }

}


          else {
            header("Location: index.php?error=noacct");
                    exit();
                  }

?>
