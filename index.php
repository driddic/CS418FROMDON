<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./assets/index.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <style media="screen">
      .github
      {
        background-color: #4CAF50; /* Green */
        display: block;
        box-sizing: border-box;
        margin-bottom: 20px;
        padding:4px;
        width: 220px;
        height: 32px;
        border: none;
        outline:none;
        border-bottom: 1px solid navy;
        font-family: sans-serif;
        font-weight: 400;
        font-size: 15px;
        transition: 0.2s ease;
      }

    </style>
    <?php
    session_start();
    //include 'homehead.php';
    ?>
<title>Welcome to goODU</title>
  </head>
  <body>
    <header>
      <div class="container">
        <div class="w3-bar w3-light-grey w3-border w3-padding">
          <a href="index.php" class="w3-bar-item w3-button w3-mobile">Log-In</a>
          <a href="signup.php" class="w3-bar-item w3-button w3-mobile">Sign-Up</a>
          <a href="homehelp.php" class="w3-bar-item w3-button w3-mobile">Help</a>
          <a href="index.php" style = "float:right" class="w3-bar-item w3-button w3-mobile">goODU</a>
        </div>
      </div>
    </header>
      <div id="login-box">
        <form action= "login.php" method="POST" >

        <div>
                <h1>Login</h1>
                <input type="text" name="username" id="uname" placeholder="@Username">
                <input type="password" name="password" id="pword" placeholder="Password">
                <input type="submit" name="submit" value="Submit">
        </div>
        <br>
        
        <div>
            <button class="github"><a href="gitlogin.php">Sign In with GitHub</a></button>
        </div>
         </form>

      </div>

  </body>
</html>
