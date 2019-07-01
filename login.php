<?php
session_start();
include_once 'testconn.php';


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_POST['git'])){
  require "init.php";

  //this will redirect user to github authorization page
  goToAuthUrl();


  //if no redirection occur then following shows.
  echo "operation failed.";
}
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
                      //trying this but it does not work in docker
                       $sql = "SELECT * FROM users WHERE uname='".$uname."' and pword= '".$pwd."';";
                       $result = mysqli_query($conn,$sql);

                       if ($row = mysqli_fetch_assoc($result))   {
                                   //if true start a session here
                                 //
                                 session_start();
                                 $_SESSION['userid'] = $row['userid'];
                                 $_SESSION['username'] = $row['uname'];
                                 $_SESSION['password'] = $row['pwd'];

                                 //$_SESSION['logged_in']= true;
                                 //for testing
                                 header("Location: homepage.php");
                                 //for real
                                 // header("Location: authenic.php");
                                 exit();
                       }

                        else { //incase of a mistake , safe case
                              Header("Location: index.php?error=noacct");
                              exit();
                            }
                  }
}
      else {
            header("Location: index.php?error=noclicksubmit");
                    exit();
                  }


?>
