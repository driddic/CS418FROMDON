<?php

//database connection

$host = "localhost";
$user = "root";
$password="";
$db= "university";

mysqli_connect($host,$user,$password);
mysqli_select_db($db);

    if (isset($_POST['username'])) {

      $uname =$_POST['uname'];
      $password = $_POST['pword'];

      $sqli = "select * from users where uname='""'AND pword='".$password"' limit 1  ";
// login validation
      $result = mysqli_query($sqli);

      if (mysqli_num_rows($result)==1)
      {
          echo "You have logged in!";

      }
      else{
        echo "You've got the wrong password";
      }

    }
 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Welcome to ODU eVENTATION</title>
  </head>
  <body>

    <!-- <?php
    echo ($_POST["uname"]);
    // define variables and set to empty values
    $name = $email = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $name = test_input($_POST["Name"]);
      $email = test_input($_POST["email"]);
    echo $name;
    }

    function test_input($data){

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;

    }
    ?> -->

//login form
    <form action="interests.php" method="post" >
      <table>
        <tr>
          <th colspan="2"><h2 align='center'>Login</h2> </th>
        </tr>
        <tr>
        <td>Username:</td>
        <td><input type="text" name="username" id="uname"></td>

        </tr>
        <tr>
        <td>Password:</td>
        <td><input type="password" name="password" id="pword"></td>

        </tr>
        <tr>
          <td align = "right" colspan="2"><input type="submit" name="submit" value="Submit"></td>
        </tr>
      </table>
    </form>

<a href="signup.php">Want to Sign - Up?</a>


    <?php


    echo "<h2>Your Input:</h2>";
    echo $name;
    echo "<br>";
    echo $email;

    ?>
  </body>
</html>
