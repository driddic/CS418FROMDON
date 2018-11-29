<?php
include 'testconn.php';
// $target_dir = "uploads/";
// $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
// $uploadOk = 1;
//$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


// check for uploaded file
if(isset($_FILES['upload']))
{
        // file name, type, size, temporary name
        $file_name = $_FILES['upload']['name'];
        $file_type = $_FILES['upload']['type'];
        $file_tmp_name = $_FILES['upload']['tmp_name'];
        $file_size = $_FILES['upload']['size'];

        // target directory
        $target_dir = "uploads/";

        // uploding file
        if(move_uploaded_file($file_tmp_name,$target_dir.$file_name)){

          // query
          $q = "INSERT INTO profileimage(status) VALUES('.$target_dir.$file_name.')";

          // run query
          $r = mysqli_query($conn,$q);

          if(mysqli_affected_rows($conn) == 1)
          {
            echo "<p style='color:green'><b>File has been successfully uploaded</b></p>";
            header("location: profile.php?succes");
            exit();
          }
          else
          {
          echo "<p>A system error has been occured</p>".mysqli_error($conn);
          }
        }
        else{
          echo "File can not be uploaded";
        }
}







// // Check if image file is a actual image or fake image
// if(isset($_POST["upload"])) {
//     $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//     if($check !== false) {
//         echo "File is an image - " . $check["mime"] . ".";
//         $uploadOk = 1;
//     } else {
//         echo "File is not an image.";
//         $uploadOk = 0;
//     }
// }
// // Check if file already exists
// if (file_exists($target_file)) {
//     echo "Sorry, file already exists.";
//     $uploadOk = 0;
// }
// // Check file size
// if ($_FILES["fileToUpload"]["size"] > 500000) {
//     echo "Sorry, your file is too large.";
//     $uploadOk = 0;
// }
// // Allow certain file formats
// if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
// && $imageFileType != "gif" ) {
//     echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//     $uploadOk = 0;
// }
// // Check if $uploadOk is set to 0 by an error
// if ($uploadOk == 0) {
//     echo "Sorry, your file was not uploaded.";
// // if everything is ok, try to upload file
// } else {
//     if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
//         echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
//     } else {
//         echo "Sorry, there was an error uploading your file.";
//     }
// }
?>
