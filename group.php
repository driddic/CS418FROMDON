<?php session_start();

include 'header.php';
require_once 'groupsearch.php';
//require_once 'groupadd.php';
//include_once 'groupadd.php';

$sessname =$_SESSION['username'];
$sessid = $_SESSION['userid'];

 ?>
     <main>

      <!-- Group Creation  -->

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


        <!-- Group Search -->

       <div align=center>
          <h1>Search a Group</h1>
          <form action="group.php" method="post">
             <input type="text" name="grpsearch" placeholder="Search for groups">
             <input type="submit" name="grphit" value="Search">
          </form>
       </div>
         <div align = center>
          <h1>My Groups</h1>
          <form action = 'groupinvite.php' method = 'post'>
            <?php
              //listing groups the user is in
               $sql = "SELECT groups.grpname, groups.grpid
                       FROM (( membership INNER JOIN users on membership.userid = users.userid)
                       INNER JOIN groups on membership.grpid = groups.grpid)
                       WHERE users.userid = '".$sessid."';";
               $show = mysqli_query($conn, $sql);
               if(mysqli_num_rows($show) > 0){
                  // if one or more rows are returned do following
               while ($results = mysqli_fetch_assoc($show))?>
               <button onclick = "reveal()"'>'.$results['grpname'].'</button>
               <div id = 'myDIV'>
                 <button onclick = "revealagain()"'>Invite New Members</button>
                   <div id = 'mytwoDIV'>
                     <p>Add New Person</p>
                     </div>
               </div>
               </form>
          <?php
            //listing groups the user is in
             $sql = "SELECT groups.grpname, groups.grpid
                     FROM (( membership INNER JOIN users on membership.userid = users.userid)
                     INNER JOIN groups on membership.grpid = groups.grpid)
                     WHERE users.userid = '".$sessid."';";
             $show = mysqli_query($conn, $sql);
             if(mysqli_num_rows($show) > 0){
                // if one or more rows are returned do following
             while ($results = mysqli_fetch_assoc($show)){
             echo "<form action = 'groupinvite.php' method = 'post'>

                  <button onclick = "reveal()"'>'.$results['grpname'].'</button>
                  <div id = 'myDIV'>
                    <button onclick = "revealagain()"'>Invite New Members</button>
                      <div id = 'mytwoDIV'>
                        <p>Add New Person</p>
                        </div>
                  </div>
                  </form>";

                 }
               }
            ?>
           </div>



           <?php
           // Search Results

           if(mysqli_num_rows($rawresults) > 0){ // if one or more rows are returned do following
               while($results = mysqli_fetch_array($rawresults)){
                 if(!empty($_POST['grpsearch'])){
                     if ($results['access'] == 'public') { //if group access is public show those groups

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

     <script type="text/javascript">
     function reveal() {
          var x = document.getElementById("myDIV");
          if (x.style.display === "none") {
          x.style.display = "block";} else {
          x.style.display = "none";}}

      function revealagain() {
               var x = document.getElementById("mytwoDIV");
               if (x.style.display === "none") {
               x.style.display = "block";} else {
               x.style.display = "none";}}


     </script>
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
