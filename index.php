<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

  </head>
  <body>
    <?php
    session_start();
    include 'homehead.php';
     ?>
    <form action= "login.php" method="POST" >
      <div id="login-box">
        <div>
                <h1>Login</h1>
                <input type="text" name="username" id="uname" placeholder="@Username">
                <input type="password" name="password" id="pword" placeholder="Password">
                <input type="submit" name="submit" value="Submit">
        </div>
      </div>
    </form>
  </body>
</html>
