<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo $_SESSION['uname'];?> | goODU</title>
    <script src="./assets/index.js"></script>
    <link rel="stylesheet" type="text/css" href="./assets/index.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

  </head>
  <body>

     <header>
       <div id="container">
         <div class="w3-bar w3-light-grey w3-border w3-padding" >
             <a href="homepage.php" class="w3-bar-item w3-button w3-mobile">Home</a>
             <a href="profile.php" class="w3-bar-item w3-button w3-mobile">Profile</a>
             <a href="group.php" class="w3-bar-item w3-button w3-mobile">Groups</a>
             <a href="help.php" class="w3-bar-item w3-button w3-mobile">Help</a>
             <a href="logout.php" style = "float:right" type = "logout" name = "logout"
             class="w3-bar-item w3-button w3-mobile">Logout</a>

             <form style = "float:right" action="search.php" method="POST" >
             <input type="text" name="query" class="w3-bar-item w3-input w3-white"
              placeholder="Search Users.." size = "70">
             <button type="submit" class="w3-bar-item w3-button w3-grey w3-mobile" >goODU</button>
             </form>
        </div>
       </div>
     </header>

</body>
</html>
<?php  if (!isset($_SESSION['username']))
{
  echo "not logged in";
  header("Location: index.php?error=loginfirst");
  exit();
}
?>
