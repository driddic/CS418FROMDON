<?php
session_start();
include 'homehead.php';
 ?>

<main>
  <form action= "login.php" method="POST" >
    <div id="login-box">
      <div align = center class="right-box">
              <h1>Login</h1>
              <input type="text" name="username" id="uname" placeholder="@Username">
              <input type="password" name="password" id="pword" placeholder="Password">
              <input type="submit" name="submit" value="Submit">
      </div>
    </div>
  </form>
</main>
