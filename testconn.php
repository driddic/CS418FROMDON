<?php


// echo $_REQUEST['name'];
// Create connection
//$conn = mysqli_connect("localhost","admin","monarch", "University");
$servername = 'localhost';
$user = 'root';
$password='';
$db= 'university';
$conn = mysqli_connect("localhost","root","","university") OR die("Server Connection error");
mysqli_select_db($conn,$db) OR die("DB error");



//Check connection
if (!$conn) {
  header("Location: index.php?error=noconn");
  exit();
} else{
    echo "Connected";
}
//
// $name = mysqli_real_escape_string($conn,$_REQUEST['uname']);
// $password = mysqli_real_escape_string($conn,$_REQUEST['pword']);
// //$sql = "INSERT INTO Student(Name,Email) VALUES ('$name','$email')";
//
//
// //if sql worked properly
//
// if (mysqli_query($conn,$sql)) {
//     echo "New record created successfully";
// } else {
//     echo "Error: ".mysqli_error($conn);
// }
//
// mysqli_close($conn);



?>
