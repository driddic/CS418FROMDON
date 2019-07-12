<?php session_start();
include 'header.php';
require_once 'groupsearch.php';

    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);
//require_once 'groupadd.php';
//include_once 'groupadd.php';
$sessname =$_SESSION['username'];
$sessid = $_SESSION['userid'];

$five = "SELECT * FROM users";
$fiveyes = mysqli_query($conn, $five);
 ?>

 <style media="screen">
   h1 {
     font-family: "Times New Roman", Times, serif;
     font-size:1.5vw;
   }
  .swap{
    border-radius: 15px;
    border: 2px solid lightblue;
    padding: 20px;
    width: 700px;
    height: auto;
  }
  .swap input{
    border-radius: 5px;
  }

  form.openS button {
    float: left;
    width: 20%;
    padding: 10px;
    background: #2196F3;
    color: white;
    font-size: 7px;
    border: 1px solid grey;
    border-left: none; /* Prevent double borders */
    cursor: pointer;
  }
  #bigbox {
    /* Header Height */
    /* bottom: 10px; /* Footer Height */

    width: 36.8%;
    height: auto;
  }
  /* The container */
  .contract {
   display: block;
   position: relative;
   padding-left: 35px;
   margin-bottom: 12px;
   cursor: pointer;
   font-size: 22px;
   -webkit-user-select: none;
   -moz-user-select: none;
   -ms-user-select: none;
   user-select: none;
 }

 /* Hide the browser's default radio button */
 .contract input {
   position: absolute;
   opacity: 0;
   cursor: pointer;
 }

 /* Create a custom radio button */
 .checkmark {
   position: absolute;
   top: 0;
   left: 0;
   height: 25px;
   width: 25px;
   background-color: #eee;
   border-radius: 50%;
 }

 /* On mouse-over, add a grey background color */
 .contract:hover input ~ .checkmark {
   background-color: #ccc;
 }

 /* When the radio button is checked, add a blue background */
 .contract input:checked ~ .checkmark {
   background-color: #2196F3;
 }

 /* Create the indicator (the dot/circle - hidden when not checked) */
 .checkmark:after {
   content: "";
   position: absolute;
   display: none;
 }

 /* Show the indicator (dot/circle) when checked */
 .contract input:checked ~ .checkmark:after {
   display: block;
 }

 /* Style the indicator (dot/circle) */
 .contract .checkmark:after {
  	top: 9px;
 	left: 9px;
 	width: 8px;
 	height: 8px;
 	border-radius: 50%;
 	background: white;
 }
 </style>

     <main>
       <div id= "bigbox">
         <div class="margin1">
         <div class="swap">
           <h1>Recommended Groups</h1>
           <?php
                include 'recommended.php';
            ?>
          </div>
            <div class="swap">
              <h1>Notifications</h1>
           <!-- If a user is invited to join a group the button to join will show here -->
           <?php
                $query = "SELECT active, grpid FROM membership WHERE userid = ".$sessid."";
                $yo = mysqli_query($conn, $query);
                if(mysqli_num_rows($yo) > 0){
                   // if one or more rows are returned do following
                while ($results = mysqli_fetch_assoc($yo)){
                  $hello = $results["active"];
                  $id = $results["grpid"];
                }
              }
                  if ($hello == 1) {
                    // show the group number, name and join button
                    $selection = "SELECT grpname FROM groups WHERE grpid = '$id' ";
                    $sele = mysqli_query($conn, $selection);
                    if(mysqli_num_rows($sele) > 0){
                       // if one or more rows are returned do following
                    while ($results = mysqli_fetch_assoc($sele)){
                      $groupE = $results["grpname"];
                    }
                  }
                    ?>
                      <form action='groupsettings.php' method="post">
                      <input type='hidden' name= 'sessid' id="sessid" value='<?php echo $sessid ?>'>
                      <input type='hidden' name= 'groupid' id="groupid" value='<?php echo $id?>'><?php echo $groupE ?>
                      <button type='submit' name='status' >Join</button>
                      </form>
                    <?php
                      }//closing brackets
                     ?>
         </div>
       </div>


         <div class="margin2">
           <div class="swap">
         <h1 align=center>Create a Group</h1>
         <form action="groupmake.php" method="post">
           <input type="text" name="groupname" placeholder="Name the Group">
           <input class="contract" type="radio" name="access" value="private" >private
           <input type="radio" name="access" value="public" checked>public
           <input type="hidden" name = "user" value="<?php $sessname ?>">
           <input type="submit" name="groupsubmit" value="Submit">
         </form>
       </div>

         <div class="swap">
           <h1>Search a Group</h1>
           <form action="group.php" method="post">
             <input type="text" name="grpsearch" placeholder="Search for groups">
             <input type="submit" name="grphit" value="Search">
           </form>
           <div style="background-color: lightgrey;">
             <?php ///List results for groups searched
             if(mysqli_num_rows($rawresults) > 0){ // if one or more rows are returned do following
                 while($results = mysqli_fetch_array($rawresults)){
                   if(!empty($_POST['grpsearch'])){
                       if ($results['access'] == 'public') {
                           echo "
                                 <p><h3>".$results['grpname']."</h3></p>
                                 <p> Owner: ".$results['owner']."</p>
                                 <form action='groupadd.php' method ='post'>
                                 <input type='hidden' name= 'groupid' value='".$results['grpid']."'>
                                 <input type='hidden' name= 'uname' value='".$sessname."'>
                                 <input type='hidden' name= 'uid' value='".$sessid."'>
                                 <button type='submit' name='join'>Join</button>
                                 </form>
                               ";
                             }
                       else {
                         echo "<p><h3>".$results['grpname']."</h3></p>
                               <p> Owner: ".$results['owner']."</p>
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
       </div>


         <div class="swap">
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

                    <?php
                    echo "<form action='setting.php' method='post'>
                          <input type='hidden' name='group' id='group' class='form-control' value= '$currentgroup' />
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
                      $show = "SELECT uname FROM users ";
                              // echo "query ran:" .$show;
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
                  <input type="submit" name = "invitation">
                  </form>
                    <?php
                    }

         }else {
           echo "No group exist";
         }
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
</div>
            <div align=center>




         </div>
       </div>

     </main>
