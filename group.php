<?php session_start();
include 'header.php';
require_once 'groupsearch.php';

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
//require_once 'groupadd.php';
//include_once 'groupadd.php';
$sessname =$_SESSION['username'];
$sessid = $_SESSION['userid'];

$five = "SELECT * FROM users";
$fiveyes = mysqli_query($conn, $five);

 ?>
     <main>
       <div id= "bigbox">
         <div align=center>
           <h1>Recommended Groups</h1>
           <br>
           <?php
            //Recommended by groups those in direct messages who are not in a group together

            //SELECT groups.grpid,recip,grpname FROM ((`membership` INNER JOIN messageroom on membership.userid = messageroom.recip) INNER JOIN groups on membership.grpid = groups.grpid) WHERE messageroom.sender = '1'
          



            ?>
           <h1>Notifications</h1>
           <!-- If a user is invited to join a group the button to join will show here -->
           <?php
                //may have to inner join
                $query = "SELECT active, grpid FROM membership WHERE userid = ".$sessid."";
                $yo = mysqli_query($conn, $query);
                if(mysqli_num_rows($yo) > 0){
                   // if one or more rows are returned do following
                while ($results = mysqli_fetch_assoc($yo)){
                  $hello = $results["active"];
                  $id = $results["grpid"];
                }
                  echo "The number is: ".$hello;
                  if ($hello == 1) {
                    // show the group number and join button
                    ?>
                      <form action='groupadd.php' method="post">
                      <input type='hidden' name= 'sessid' id="sessid" value='<?php echo $sessid ?>'><?php echo $sessid; ?>
                      <input type='hidden' name= 'groupid' id="groupid" value='<?php echo $id?>'><?php echo $id; ?>
                      <button  type='submit' name='status' >Join</button>
                      </form>
                    <?php
                    //closing brackets
                  }
              }
           ?>
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
         <div align=center>
           <h1>My Groups</h1>
           <!-- list groups -->
           <?php
            if ($sessid == 9) {
              $seegroup = "SELECT grpname, grpid FROM groups WHERE archive = 0";
              $show = mysqli_query($conn, $seegroup);
              if(mysqli_num_rows($show) > 0){
                 // if one or more rows are returned do following
              while ($results = mysqli_fetch_assoc($show)){
              echo "<div>
                   <a href='group.php?groupid=".$results["grpid"]."'name ='".$results["grpname"]."'class='w3-bar-item w3-button'>  ".$results["grpname"]."</a>
                     </div>";
                  }
                }
            }else {
              //listing groups the user is in and shows what is not archived
               $sql = " SELECT groups.grpname, groups.grpid
                       FROM (( membership INNER JOIN users on membership.userid = users.userid)
                       INNER JOIN groups on membership.grpid = groups.grpid)
                       WHERE users.userid = '".$sessid."'
                       and membership.active = 0
                       and groups.archive = 0";
               $show = mysqli_query($conn, $sql);
               if(mysqli_num_rows($show) > 0){
                  // if one or more rows are returned do following
               while ($results = mysqli_fetch_assoc($show)){

               echo "<div>
                    <a href='group.php?groupid=".$results["grpid"]."'name ='".$results["grpname"]."'class='w3-bar-item w3-button'>  ".$results["grpname"]."</a>
                      </div>";

                 }
                 }
            }
            //once a group is selected you will be able to invite more members based off
                //a list where users not on this groups memeber list.
                $currentgroup= $_GET['groupid'];
                if (!$currentgroup) {
                 echo "select a group";
               }else if(isset($currentgroup)) {
                 //show members of group selected
                 echo "Group Settings";
                 echo "</br>";
                 if ($sessid == 9) {
                   ?>
                   <form action="setting.php" method="post">
                     <input type="hidden" name="group" value="<?php echo $currentgroup;?>">
                     <input type="submit" name="archive" value="Archive">
                   </form>

                   <?php
                 }
                 echo "Memeber list";
                 echo "</br>";
                 //query for members in groups
                $memb= "SELECT users.uname FROM (( membership INNER JOIN users on membership.userid =
                        users.userid) INNER JOIN groups on membership.grpid = groups.grpid)
                        WHERE membership.grpid = '".$currentgroup."'
                        AND membership.active = 0";
                $show = mysqli_query($conn, $memb);
                if(mysqli_num_rows($show) > 0){
                   // if one or more rows are returned do following
                while ($results = mysqli_fetch_assoc($show)){
                  if ($sessid == 9) {
                    $namename=$results["uname"];
                    ?>
                    <form action="setting.php" method="post">
                    <?php
                    echo "<input type='hidden' name='group' id='group' class='form-control' value= '$currentgroup' />
                          <input type='checkbox' name='name' id='name' class='form-control' value= '$namename' />$namename
                          ";

                    ?>
                    <input type="submit" name="remove" value="Remove">
                    </form>
                    <?php
                  }else {
                    echo $results["uname"];
                    echo "<br/>";}
                  }

                  ?>
                  <h3>Invite</h3>
                  <form action="groupsettings.php" method="post">
                  <select name='invite'>
                    <?php
                      $show = "SELECT uname FROM membership WHERE NOT grpid ='$currentgroup'";
                              echo "query ran:" .$show;
                              $see = mysqli_query($conn, $show);
                              if(mysqli_num_rows($see) > 0){
                                 // if one or more rows are returned do following
                              while ($result = mysqli_fetch_assoc($see)){
                                // create a checkbox form to add them
                              echo "<option value='".$result["uname"]."''>".$result["uname"]."</option>";

                            }
                      }
                      echo "<input type= 'hidden' name='group' value='".$currentgroup."' >";
                      ?>
                    </select>
                    <br><br>
                  <input type="submit">
                  </form>
                    <?php
                    }

         }else {
           echo "No group exist";
         }
                //
          ///Archived Groups

            ?>

            <div align=center>
              <?php
              if ($sessid == 9) {
                // code...
              echo "<h1>Archived Groups</h1>";
              $notgroup = "SELECT grpname, grpid FROM groups WHERE archive = 1";
              $archived = mysqli_query($conn, $notgroup);
              if(mysqli_num_rows($archived) > 0){
                 // if one or more rows are returned do following
              while ($results = mysqli_fetch_assoc($archived)){
                $yesid = $results["grpid"];
                $yesname = $results["grpname"];
              echo "<form action='setting.php' method='post'>
                   <input type = 'hidden' name='group'  id = 'group' class='form-control' value='$yesid'>
                   <input type = 'hidden' name = 'groupn' id = 'groupn' class='form-control' value = '$yesname'>$yesname
                   <button type='submit' name = 'unarchive' id = 'unarchive' value = 'Unarchive'>Unarchive<button>
                     </form>";
                  }
                }

            }
              ?>

            <div align=center>



           <?php ///List results for groups searched
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
