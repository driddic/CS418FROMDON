<?php
session_start();
require 'testconn.php';
//error handling code.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$error = '';
$comment_content = '';


//picture stuff



if (isset($_POST['postUpload'])) {
  if($_FILES["file"]["name"] != '')
  {
   $test = explode('.', $_FILES["file"]["name"]);
   $ext = end($test);
   $name = rand(100, 999) . '.' . $ext;
   $location = './upload/' . $name;
   move_uploaded_file($_FILES["file"]["tmp_name"], $location);
   echo '<img src="'.$location.'" height="150" width="225" class="img-thumbnail" />';
  }
  // $file = $_FILES['image'];
  // $file_name = $_FILES['image']['name'];
  // $file_type = $_FILES['image']['type'];
  // $file_tmp_name = $_FILES['image']['tmp_name'];
  // $file_size = $_FILES['image']['size'];
  // $file_error = $_FILES['image']['error'];
  //
  // $fileExt = explode('.', $file_name);
  // $fileActualExt = strtolower(end($fileExt));
  //
  // $allowed = array('jpg','jpeg', 'png', 'gif');
  //
  // if (in_array($fileActualExt, $allowed)) {
  //   if ($file_error == 0){
  //     if ($file_size < 1000000) {
  //       //change the status of the users profile image
  //       $file_name_new = rand(100,999).time().".".$fileActualExt;
  //       $file_destination = 'upload/'.$file_name_new;
  //       move_uploaded_file($file_tmp_name,$file_destination);
  //       echo "Good job";
  //     }
  //     else {
  //       echo "Your file is too big!";
  //     //  header("Location: profile.php?error_size");
  //     }
  //   }
  //   else {
  //     echo "There was an error uploading your file!";
  //   //  header("Location: profile.php?error_upload");
  //   }
  // }
  //
  // else {
  //
  //   echo "You cannot upload files of this type!";
  //   //header("Location: profile.php?error_filetype");
  // }

}




if(empty($_POST["comment_content"])){
 $error .= '<p class="text-danger">Comment is required</p>';
}else{
 $comment_content = mysqli_real_escape_string($conn, $_POST["comment_content"]);
 echo "go comment_content";
}
  echo "</br>";
if(empty($_POST["comment_name"])){
 $error .= '<p class="text-danger">No user</p>';
}else{
 $commentuser = $_POST["comment_name"];
 echo "go comment_name";
}
  echo "</br>";
if(empty($_POST["user_id"])){
 $error .= '<p class="text-danger">No user id</p>';
}else{
 $commentusid = $_POST["user_id"];
 echo "go comment_id";
}
  echo "</br>";
 if(empty($_POST["group_num"])){
 $error .= '<p class="text-danger">No group selected</p>';
}else{
 $groupnum = $_POST["group_num"];
 echo "go group_num";
}
  echo "</br>";
if(empty($_POST["comment_time"])){
$error .= '<p class="text-danger">No time input</p>';
}else{
$dateandtime = $_POST["comment_time"];
echo "go time";
}
if ($_POST["code_upload"] == 1) {
  $code = $_POST["code_upload"];
}else {
  echo "no code";
}
$commentnum = $_POST["comment_id"];
//   if(empty($_POST["comment_id"])){
//     echo "</br>";
//     $error .= '<p class="text-danger">No comment id';
//   }else{
//     $commentnum = $_POST["comment_id"];
//     echo "comment number: ".$commentnum;
// }
    // echo "complete";

//if there is no errors,  connect to db, run query, and show success message
//displaying the error message
      if($error == ''){
      echo  $query = "INSERT INTO tbl_comment(comment_id, parent_comment_id, message, image, uid, comment_sender_name, date, grpid, voteup, votedown, code )
        VALUES (NULL,'$commentnum ', '$comment_content','$tool','$commentusid' ,'$commentuser', CURRENT_TIMESTAMP, $groupnum,'','','$code')";
        $score = mysqli_query($conn, $query);
        //header("Location:homepage.php?groupid='$groupnum'");
        //for debugging!!!!
        // echo "The comment is ".$comment_content;
        // echo "</br>";
        // echo "This is group number ".$groupnum;
        // echo "</br>";
        // echo "The query is ".$query;
        // $error = '<label class="text-success">Comment Added </label>';
      }
      $data = array('Time Out:'  => $error);
     echo json_encode($data);
?>
