<?php
//session_start();
require 'testconn.php';
//error handling code.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$error = '';

if(isset($_POST['submit']))
{
  // file name, type, size, temporary name
        $file = $_FILES['uploadFile'];
        $file_name = $_FILES['uploadFile']['name'];
        $file_type = $_FILES['uploadFile']['type'];
        $file_tmp_name = $_FILES['uploadFile']['tmp_name'];
        $file_size = $_FILES['uploadFile']['size'];
        $file_error = $_FILES['uploadFile']['error'];

        $fileExt = explode('.', $file_name);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg','jpeg', 'png', 'pdf');

        if (in_array($fileActualExt, $allowed)) {
          if ($file_error == 0){
            if ($file_size < 1000000) {
              //change the status of the users profile image
              $file_name_new = "uploads".$sessid.".".$fileActualExt;
              $file_destination = 'assets/'.$file_name_new;
              //$sqlupdate = "UPDATE profileimage SET status = 0 and keep = 1 WHERE userid = '$sessid' ";
              //$result = mysqli_query($conn, $sqlupdate);
              move_uploaded_file($file_tmp_name,$file_destination);
              //header("Location: profile.php?uploadsuccess");
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
if(empty($_POST['comment_content'])){
 $error .= '<p class="text-danger">Comment is required</p>';
}else{
 $comment_content = $_POST['comment_content'];
 echo "go comment_content";
}
  echo "</br>";
 $commentuser = $_POST["comment_name"];
  echo "</br>";
 $commentusid = $_POST["user_id"];
 $groupnum = $_POST["group_num"];
$dateandtime = $_POST["comment_time"];
  echo "</br>";
  $commentnum = $_POST["comment_id"];
  echo "complete";


//if there is no errors,  connect to db, run query, and show success message
//displaying the error message

      if($error == ''){

        $query = "INSERT INTO tbl_comment(comment_id, parent_comment_id, message, image, uid, comment_sender_name, date, grpid, vote)
        VALUES (NULL,'$commentnum ', '$comment_content', '$image','$commentusid' ,'$commentuser', CURRENT_TIMESTAMP, $groupnum, ' ' )";
        $score = mysqli_query($conn, $query);
        echo "query";
        header("Location:homepage.php?groupid='$groupnum'");
        //for debugging!!!!
        // echo "The comment is ".$comment_content;
        // echo "</br>";
        // echo "This is group number ".$groupnum;
        // echo "</br>";
        // echo "The query is ".$query;
       $error = '<label class="text-success">Comment Added </label>';

      }
      $data = array('Time Out:'  => $error);
     echo json_encode($data);

 ?>
