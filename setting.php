<?php
session_start();
require 'testconn.php';
include 'header.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// in this file i will be making space for the admin
// to remove users from groups
// invite users to groups
// archive groups
// edit membership
// deleting posts

if (isset($_POST['delete'])) {
    $cid = $_POST["delete"];
    $sql = "DELETE FROM tbl_comment
            WHERE comment_id = '$cid'";
          //  echo $sql;
    mysqli_query($conn, $sql);
    header("Location: homepage.php?goodremove");
    exit();
}
if (isset($_POST['remove'])) {
    $cname = $_POST["name"];
    //echo $cname;
    $group = $_POST["group"];
    //echo $group;
     $sql = "DELETE FROM membership
             WHERE  grpid = '$group'
             AND uname = '$cname'";
     mysqli_query($conn, $sql);
    header("Location: group.php?removedfromgroup");
    exit();
}
if (isset($_POST['archive'])) {
    $groupg = $_POST["group"];
    $arch = "UPDATE groups SET archive= 1 WHERE grpid = '$groupg' ";
    mysqli_query($conn, $arch);
    header("Location: group.php?hidden");
    exit();
}
if (isset($_POST['unarchive'])) {
    $groupn = $_POST["group"];
    $unarch = "UPDATE groups SET archive= 0 WHERE grpid = '$groupn' ";
    mysqli_query($conn, $unarch);
    header("Location: group.php?placed");
    exit();
}


 ?>
