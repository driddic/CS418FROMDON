


<!DOCTYPE HTML>
<html>
<head>
</head>
<body>


<?php
echo ($_POST["name"]);
// define variables and set to empty values
$name = $email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["Name"]);
  $email = test_input($_POST["email"]);
echo $name;
}

function test_input($data){

$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);

return $data;

}

?>
<form action="test.php" method="post" >

  Name: <input type="text" name="name" id="name">
  <br><br>

  E-mail: <input type="text" name="email" id="email">
  <br><br>

  <input type="submit" name="submit" value="Submit">
</form>




<?php


echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $email;

?>
