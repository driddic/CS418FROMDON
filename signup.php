<?php
include 'homehead.php'; ?>
<style media="screen">
  .github
  {
    background-color: #4CAF50; /* Green */
  }

</style>
<main>

  <form action= "register.php" method="POST" >
    <div id="login-box">
      <div align="center">
        <h1>Sign Up</h1>
          <input type="text" name="username" id="uname" placeholder="@Username">
          <input type="password" name="password" id="pword" placeholder="Password">
          <input type="password" name="password-rep" id="pword" placeholder="Retype Password">
          <input type="text" name="Email" id="email" placeholder="Email">
          <input type="text" name="firstname" id="fname" placeholder="First Name">
          <input type="text" name="lastname" id="lname" placeholder="Last Name">
          <div class="g-recaptcha"  data-sitekey="6LcugX8UAAAAAKBN8xRtZk_IIC_zM5jJ0VXoCI1N"></div>
          <input type="submit" name="su-submit" value="Submit">
      </div>
      <br>
      <br>
      <div align = "center">
          <!-- <button class="github"><a href="gitsignup.php">Sign Up with GitHub</a></button> -->
      </div>
    </div>
  </form>
</main>
