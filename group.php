<?php session_start();
include 'header.php';
require_once 'groupsearch.php';
//require_once 'groupadd.php';
//include_once 'groupadd.php';
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
         <div align=center>
           <h1>Search a Group</h1>
           <form action="group.php" method="post">
             <input type="text" name="grpsearch" placeholder="Search for groups">
             <input type="submit" name="grphit" value="Search">
           </form>
         </div>
         <div align = center>
           <?php

           if(mysqli_num_rows($rawresults) > 0){ // if one or more rows are returned do following
               while($results = mysqli_fetch_array($rawresults)){
                 if(!empty($_POST['grpsearch'])){
                     if ($results['access'] == 'public') {

                         echo "
                               <p><h3>".$results['grpname']."</h3></p>
                               <p>".$results['owner']."</p>
                               <form action='groupadd.php'>
                               <input type='hidden' name= 'groupid' value='".$results['grpid']."'>
                               <button  type='submit' name='join'>Join</button>
                               </form>
                             ";
                           }

                     else {
                       echo "<p><h3>".$results['grpname']."</h3></p>
                             <p>".$results['owner']."</p>
                           ";
                         }
               }
               else {
                 header("location:group.php?error=emptyfield");
                 exit();
               }
             }


         }
         else {
           // if there is no matching rows do following
              echo "No results";

         }
          ?>
         </div>
       </div>
     </main>
     <!-- // was to have a view option for users who was already in the group
     // if(mysqli_num_rows($result) > 0) {
     //   echo "
     //           <p><h3>".$results['grpname']."</h3></p>
     //           <p>".$results['owner']."</p>
     //           <form action='groupadd.php'>
     //           <button type='submit' name='view'>Go</button>
     //           </form>
     //         ";
     //  }
     // else { -->
