<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Welcome to goODU</title>
    <link rel="stylesheet" type="text/css" href="./assets/index.css">
  </head>
  <body>

<!-- <h1>Log In</h1> -->


     <header>
       <div class="container">

         <nav>
           <ul>

             <li class="sansserif"><a href="index.php">Home</a></li>
             <li><a href="index.php">Log-In</a></li>
             <li><a href="signup.php">Sign-Up</a></li>
             <li><a href="help.html">Help</a></li>
             <li style = "float:right" ><a href="#home">goODU</a></li>


           </ul>
         </nav>
       </div>


     </header>

    <form action= "register.php" method="POST" >
      <div id="login-box">

      

        <div class="right-box" align="center">
              <h1>Sign Up</h1>

            <input type="text" name="username" id="uname" placeholder="@Username">

              <input type="password" name="password" id="pword" placeholder="Password">

            <input type="password" name="password-rep" id="pword" placeholder="Retype Password">

              <input type="text" name="Email" id="email" placeholder="Email">

              <input type="text" name="firstname" id="fname" placeholder="First Name">

              <input type="text" name="lastname" id="lname" placeholder="Last Name">
              <input type="submit" name="su-submit" value="Submit">

        </div>
      </div>
    </form>

  </body>
</html>
