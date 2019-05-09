<?php
  // Create database connection
  $db = mysqli_connect("localhost", "root", "", "university");

  // Initialize message variable

  $msg = "";
  // If upload button is clicked ...
  if (isset($_POST['post'])) {
  	// Get image name
  	$image = $_FILES['image']['name'];
  	// Get text
  	$image_text = mysqli_real_escape_string($db, $_POST['image_text']);

  	// image file directory
  	$target = "images/".basename($image);

  	echo $sql = "INSERT INTO tbl_comment (image) VALUES ('$image')";
  	// execute query
  	mysqli_query($db, $sql);

  	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}
  }
//  $result = mysqli_query($db, "SELECT * FROM images");
?>
