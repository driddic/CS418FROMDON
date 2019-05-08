<?php
include 'testconn.php';
session_start();
$sessid = $_SESSION['userid'];
$sessname = $_SESSION["username"];

//from main homepage

if(isset($_POST["image_url"]))
{

  $group = $_POST['groupid'];
 $message = '';
 $image = '';
 if(filter_var($_POST["image_url"], FILTER_VALIDATE_URL))
 {
  $allowed_extension = array("jpg", "png", "jpeg", "gif");

   $url_array = explode("/", $_POST["image_url"]);

   $image_name = end($url_array);
   $image_array = explode(".", $image_name);
   $extension = end($image_array);
  if(in_array($extension, $allowed_extension))
  {
   $image_data = file_get_contents($_POST["image_url"]);
   $new_image_path = "upload/url".rand(100,999)."." . $extension;
   file_put_contents( $new_image_path, $image_data);
   //dont touch it
   // $location = './upload/' . $new_image_path;
   // move_uploaded_file($new_image_path, $location);
      ////cho $group;
     $message = 'Image Uploaded';
     $image = $new_image_path.'<img src="'.$new_image_path.'" height="150" width="225" class="img-responsive img-thumbnail">';
     $how = "INSERT INTO tbl_comment(parent_comment_id, image, uid, comment_sender_name, grpid)
             VALUES ('0','$new_image_path','$sessid','$sessname','$group')";
             mysqli_query($conn,$how);

  }
  else
  {
   $message = "Image not found";
  }
 }
 else
 {
  $message = 'Invalid Url';
 }
 $output = array(
  'message' => $message,
  'image'  => $image
 );
 echo json_encode($output);
}


//check for uploaded file
if(isset($_POST['upload']))
{
  // file name, type, size, temporary name
        $file = $_FILES['picupload'];
        $file_name = $_FILES['picupload']['name'];
        $file_type = $_FILES['picupload']['type'];
        $file_tmp_name = $_FILES['picupload']['tmp_name'];
        $file_size = $_FILES['picupload']['size'];
        $file_error = $_FILES['picupload']['error'];

        $fileExt = explode('.', $file_name);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg','jpeg', 'png', 'pdf');

        if (in_array($fileActualExt, $allowed)) {
          if ($file_error == 0){
            if ($file_size < 1000000) {
              //change the status of the users profile image
              $file_name_new = "profile".$sessid.".".$fileActualExt;
              $file_destination = 'assets/'.$file_name_new;
              $sqlupdate = "UPDATE profileimage SET status = 0 and keep = 1 WHERE userid = '$sessid' ";
              $result = mysqli_query($conn, $sqlupdate);
              move_uploaded_file($file_tmp_name,$file_destination);
              header("Location: profile.php?uploadsuccess");
            }
            else {
              echo "Your file is too big!";
            //  header("Location: profile.php?error_size");
            }
          }
          else {
            echo "There was an error uploading your file!";
          //  header("Location: profile.php?error_upload");
          }
        }

        else {

          echo "You cannot upload files of this type!";
          //header("Location: profile.php?error_filetype");
        }
}

if (isset($_POST['gravpick'])) {
echo "in the form";
  if(empty($_POST["option"])){
   echo "No user id";
  }else{
  Echo $answer = $_POST["option"];
  $name = $_POST["name"];
  if ($answer == 'yes') {
    // code...
    $sqlone = "UPDATE profileimage SET keep = 0 WHERE userid = '$name' ";
    $result = mysqli_query($conn, $sqlone);
    header("Location:profile.php?uid=".$name);
  }else {
    $sqltwo = "UPDATE profileimage SET keep = 1 WHERE userid = '$name' ";
    $result = mysqli_query($conn, $sqltwo);
    header("Location:profile.php?uid=".$name);
  }
}
}
if(!empty($_FILES))
{
 if(is_uploaded_file($_FILES['uploadFile']['tmp_name']))
 {
  $_source_path = $_FILES['uploadFile']['tmp_name'];
  $target_path = 'groups/' . $_FILES['uploadFile']['name'];
  if(move_uploaded_file($_source_path, $target_path))
  {
   echo '<p><img src="'.$target_path.'" class="img-thumbnail" width="200" height="160" /></p><br />';
  }
 }
}
 /////*********Graveyard
 //
 // $target_dir = "assets/";
 // $target_file = $target_dir . basename($_FILES["picupload"]["name"]);
 // $uploadOk = 1;
 // $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
 // // Check if image file is a actual image or fake image
 // if(isset($_POST["upload"])) {
 //     $check = getimagesize($_FILES["picupload"]["tmp_name"]);
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
 // if ($_FILES["picupload"]["size"] > 500000) {
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
 //     if (move_uploaded_file($_FILES["picupload"]["tmp_name"], $target_file)) {
 //       //change the status of the users profile image
 //                    $file_name_new = "profile".$sessid.".".$imageFileType;
 //                   // $file_destination = 'assets/'.$file_name_new;
 //                   $sqlupdate = "UPDATE profileimage SET status = 0 WHERE userid = '$sessid' ";
 //                   $result = mysqli_query($conn, $sqlupdate);
 //                   // move_uploaded_file($file_tmp_name,$file_destination);
 //         echo "The file ". $file_name_new. " has been uploaded.";
 //          header("Location: profile.php?uploadsuccess");
 //
 //     } else {
 //         echo "Sorry, there was an error uploading your file.";
 //       }
