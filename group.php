<?php session_start();
include 'header.php';
 ?>
     <main>
       <div id= "bigbox">
         <h1 align=center>Create a Group</h1>
         <form action="groupmake.php" method="post">
           <input type="text" name="groupname" placeholder="Name the Group">
           <input type="radio" name="access" value="private" >private
           <input type="radio" name="access" value="public" checked>public
           <input type="hidden" name = "user" value="">
           <input type="submit" name="groupsubmit" value="Submit">
         </form>

       </div>
     </main>
