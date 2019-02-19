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
                      //trying this but it does not work in docker
                       $sql = "SELECT * FROM users WHERE uname='".$uname."' and pword= '".$pwd."';";
                       $result = mysqli_query($conn,$sql);

                       if ($row = mysqli_fetch_assoc($result))   {
                                   //if true start a session here
                                 //session_start();
                                 $_SESSION['userid'] = $row['userid'];
                                 $_SESSION['username'] = $row['uname'];
                                 $_SESSION['password'] = $row['pwd'];

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




                    // if we can result database against empty fields
                    //  $sql = "SELECT * FROM users WHERE uname='".$uname."' and pword= '".$pwd."';";
                      // $result = mysqli_query($conn, $sql);
                      //
                      //
                      // if ($row = mysqli_fetch_assoc($result))
                      //
                      //
                      //
                      // {
                      //             //if true start a session here
                      //           session_start();
                      //           $_SESSION['userid'] = $row['userid'];
                      //           $_SESSION['uname'] = $row['uname'];
                      //           $_SESSION['password'] = $row['pwd'];
                      //
                      //           //$_SESSION['logged_in']= true;
                      //           header("Location: homepage.php");
                      //           exit();
                      //
                      //
                      //           // Change this portion
                      // }





          else {
            header("Location: index.php?error=noclicksubmit");
                    exit();
                  }

?>


<!-- $statement = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($statement, $sql))
{
  header("location: index.php?badsql");
  exit();
}
elseif(mysqli_stmt_prepare($statement, $sql)) {
          //if password is wrong I get a error on this line

          mysqli_stmt_bind_param($statement,"ss", $uname, $pwd);
          mysqli_stmt_execute($statement);
          $result = mysqli_stmt_get_result($statement);

          if($row = mysqli_fetch_assoc($result)){ // code...

            // if (!mysqli_stmt_bind_param($statement,"ss", $uname, $pwd)) {
            //   header("location: index.php?badpwd22");
            //   exit();
            // }

             $pwdCheck= $row['pword'];

                if (!$pwdCheck == $pwd) {
                  header("location: index.php?badpwd");
                  exit();// code...
                }
                elseif ($pwdCheck==$pwd) {
                  //session_start();
                  $_SESSION['userid']= $row['userid'];
                  $_SESSION['username']= $row['uname'];
                  //$_SESSION['password']= $row['pword'];

                  header("Location: homepage.php");
                             exit();// code...
                } -->

<!--
// if ($row = mysqli_fetch_assoc($result))
//
//
//
// {
//             //if true start a session here
//           session_start();
//           $_SESSION['userid'] = $row['userid'];
//           $_SESSION['uname'] = $row['uname'];
//           $_SESSION['password'] = $row['pwd'];
//
//           //$_SESSION['logged_in']= true;
//           header("Location: homepage.php");
//           exit();
//
//
//
// } -->
