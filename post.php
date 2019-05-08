<?php
session_start();
$sessid = $_SESSION["userid"];
$sessname = $_SESSION["username"];
$group = $_POST['grouppic'];
echo $group;
// $data = isset($_REQUEST['grouppic'])?$_REQUEST['grouppic']:"";
//     echo $data;
$db = mysqli_connect("localhost", "root", "", "university");
if($_FILES["file"]["name"] != '')
{
 $test = explode('.', $_FILES["file"]["name"]);
 $ext = end($test);
 $name = rand(100, 999) . '.' . $ext;
 $location = './upload/' . $name;
 move_uploaded_file($_FILES["file"]["tmp_name"], $location);
 echo '<img src="'.$location.'" height="150" width="225" class="img-thumbnail" />';
 $sql = "INSERT INTO images (image)
          VALUES ('$location')";
          mysqli_query($db, $sql);

$how = "INSERT INTO tbl_comment(parent_comment_id, image, uid, comment_sender_name, grpid)
        VALUES ('0','$location','$sessid','$sessname','$group')";
        mysqli_query($db,$how);
}
if (isset($_POST['button'])) {
  echo "well hello";

}
