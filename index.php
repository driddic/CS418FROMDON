


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Welcome to ODU eVENTATION</title>
  </head>
  <body>

    <!--
    // echo ($_POST["uname"]);
    // // define variables and set to empty values
    // $name = $email = "";
    //
    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //   $name = test_input($_POST["Name"]);
    //   $email = test_input($_POST["email"]);
    // echo $name;
    // }
    //
    // function test_input($data){
    //
    // $data = trim($data);
    // $data = stripslashes($data);
    // $data = htmlspecialchars($data);
    //
    // return $data;
    //
    // }
     -->

<!--Log in form-->
<h1>Log In</h1>
 <?php //error for wrong input
// if (isset($_GET['error'])) {
//   if (isset($_GET['error']=='emptyfields')) {  //check for empty fields
//   echo '<p class = "signuperror">Fill emtpy fields!</p>';
// }
// //else if ($_GET['error'] == "")
// }
// elseif ($_GET['signin']=="success") {
//   // code...
// }
 ?>

    <form action= "login.php" method="post" >
      <table>
        <tr>
          <th colspan="2"><h3 align='center'>Enter Creds</h3> </th>
        </tr>
        <tr>
        <td>Username:</td>
        <td><input type="text" name="username" id="uname" placeholder="@user"></td>

        </tr>
        <tr>
        <td>Password:</td>
        <td><input type="password" name="password" id="pword" placeholder="Password"></td>

        </tr>
        <tr>
          <td align = "right" colspan="2"><input type="submit" name="submit" value="Submit"></td>
        </tr>
      </table>
    </form>

  </body>
</html>
