<?php
session_start();


include_once 'testconn.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Checks if form has been submitted
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
if(isset ($_POST['su-submit'])){

  function post_captcha($user_response) {
      $fields_string = '';
      $fields = array(
          'secret' => '6LcugX8UAAAAAAb-jmRzWT3n_7EuJvZHcXCRIjOG',
          'response' => $user_response
      );
      foreach($fields as $key=>$value)
      $fields_string .= $key . '=' . $value . '&';
      $fields_string = rtrim($fields_string, '&');

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
      curl_setopt($ch, CURLOPT_POST, count($fields));
      curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

      $result = curl_exec($ch);
      curl_close($ch);

      return json_decode($result, true);
  }

  // Call the function post_captcha
  $res = post_captcha($_POST['g-recaptcha-response']);

  if (!$res['success']) {
      // What happens when the CAPTCHA wasn't checked
      echo '<p>Please go back and make sure you check the security CAPTCHA box.</p><br>';
      header('location:signup.php?error=nocaptcha');
      exit();
      }
  else {
    $uname = $_POST['username'];
    $pwd = $_POST['password'];
    $pwdagain = $_POST['password-rep'];
    $email = $_POST['Email'];
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    //$google = $_POST['recaptcha'];


            if (empty($uname) || empty($pwd) ||empty($email) || empty($fname) || empty($lname))
             {  //error handling for emtypy fields
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

                   elseif($pwd==$pwdagain)
                   {    // if we can result database against empty fields
             //is the input user name on the database already
                  $sql = " SELECT * FROM users WHERE uname ='".$uname."'; ";
                  $result = mysqli_query($conn,$sql);

                  if(mysqli_num_rows($result) > 0) {
                     header("Location: signup.php?error=usertaken");
                     echo "h4";

                     exit();
                   }
                  }


      $sqltwo= " INSERT INTO users (userid,fname,lname,uname,email,pword )
      VALUES ('','".$fname."', '".$lname."', '".$uname."', '".$email."', '".$pwd."'); ";
      //running sql query above
      $score = mysqli_query($conn, $sqltwo);

      echo "good insert: " .$score;

      if ($score)
       {
         $last_id = mysqli_insert_id($conn);
         echo "New record created successfully. Last inserted ID is: " . $last_id;
       }
       //'''place new users in global group automatically ''' 6 = sportscenter
       $sqlthr= "INSERT INTO membership (grpid,userid) VALUES (6,'".$last_id."');";
        echo "inserted membership";
       $scoreagain = mysqli_query($conn, $sqlthr);
       //insert member into profileimage table on the db
       $sqlfive = "INSERT INTO profileimage (userid, status) VALUES ('".$last_id."', 1);";
       echo "image set";
       $scored = mysqli_query($conn, $sqlfive);
        Header("location: index.php?signup=good");

        exit();
       }



}

    mysqli_close($conn);
