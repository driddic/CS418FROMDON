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
     $message = 'Image Uploaded. Refresh the page';
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
             $file_name_new = "profile".$sessid."".rand(100,999).".".$fileActualExt;
            echo   $file_destination = 'assets/'.$file_name_new;
              $sqlupdate = "UPDATE profileimage SET keep = 1 WHERE userid = '$sessid' ";
              $result = mysqli_query($conn, $sqlupdate);
              $sqlupdatetwo = "UPDATE profileimage SET status = 0 WHERE userid = '$sessid' ";
              mysqli_query($conn,$sqlupdatetwo);
              move_uploaded_file($file_tmp_name,$file_destination);
              $place = "UPDATE profileimage SET locate = '$file_destination' WHERE userid = '$sessid'";
              echo $firs=  mysqli_query($conn,$place);
              echo "string";
              header("Location: profile.php?uid=".$sessid);
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
