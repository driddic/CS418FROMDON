<?php session_start();
include 'header.php';
$sessname =$_SESSION['username'];
$sessid = $_SESSION['userid'];

 ?>
     <main>
       <div id= "bigbox">
         <div align= center>


         <h1 align=center>Create a Group</h1>
         <form action="groupmake.php" method="post">
           <input type="text" name="groupname" placeholder="Name the Group">
           <input type="radio" name="access" value="private" >private
           <input type="radio" name="access" value="public" checked>public
           <input type="hidden" name = "user" value="<?php $sessname ?>">
           <input type="submit" name="groupsubmit" value="Submit">
         </form>
         </div>
       </div>
     </main>
