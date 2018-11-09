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

    <form action= "register.php" method="post" >
      <div id="login-box">

        <!-- <div class="left-box">
          <h1>Login</h1>


              <h3>Enter Creds</h3>
                <input type="text" name="username" id="uname" placeholder="@user">
                <input type="password" name="password" id="pword" placeholder="Password">
                <input type="submit" name="submit" value="Submit">


        </div> -->

        <div class="right-box" align="center">
              <h1>Sign Up</h1>

            <input type="text" name="username" id="uname" placeholder="@username">

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
<!--
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
      </table> -->
