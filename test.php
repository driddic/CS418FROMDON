<?php

echo $_REQUEST['name'];
// Create connection
//$conn = mysqli_connect("localhost","admin","monarch", "University");

$conn = mysqli_connect("localhost","root","", "University");

// Check connection
if (!$conn == true) {
    die("Connection failed: " . mysqli_connect_error($conn));
} else{
	echo "Connected";
}


$name = mysqli_real_escape_string($conn,$_REQUEST['name']);
$email = mysqli_real_escape_string($conn,$_REQUEST['email']);
//$sql = "INSERT INTO Student(Name,Email) VALUES ('$name','$email')";


//if sql worked properly

if (mysqli_query($conn,$sql)) {
    echo "New record created successfully";
} else {
    echo "Error: ".mysqli_error($conn);
}

mysqli_close($conn);



?>
