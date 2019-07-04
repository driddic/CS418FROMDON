<?php
include 'homehead.php'; ?>
<style media="screen">
  .github
  {
    background-color: #4CAF50; /* Green */
  }
  .credsgoHere {
    position: absolute;
    left:  0;
    margin: 20px;
    max-width: 350px;
    padding: 16px;
    background-color: white;
  }

  .credsgoHere h1{
    color: inherit;
  }
</style>
<main>

    <div id="login-box">
      <form action= "register.php" method="POST" class="credsgoHere">
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

    </div>
  </form>
</main>
