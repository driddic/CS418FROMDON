<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Welcome to goODU</title>
    <link rel="stylesheet" type="text/css" href="./assets/index.css">
  </head>
  <body>




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

    <form action= "login.php" method="POST" >
      <div id="login-box">

        <div class="left-box">
          <h1>Login</h1>


              <h3>Enter Creds</h3>
                <input type="text" name="username" id="uname" placeholder="@Username">
                <input type="password" name="password" id="pword" placeholder="Password">
                <input type="submit" name="submit" value="Submit">


        </div>


      </div>
    </form>





  </body>
</html>
