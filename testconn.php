<?php


// echo $_REQUEST['name'];
// Create connection
//$conn = mysqli_connect("localhost","admin","monarch", "University");
$host = "localhost";
$user = "root";
$password="";
$db= "university";
$conn = mysqli_connect($host,$user,$password,$db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error($conn));
} else{
	// echo "Connected";
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
