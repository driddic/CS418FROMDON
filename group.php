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
          //this is the recommended group ideas
          // if a user is in a direct message with one they are not in a group with,
          // recommend the group with the largest member list for each conversation
          //get conversations.
          $dmq = "SELECT Distinct * FROM messagecontrol WHERE userOne = '$sessname' or userTwo = '$sessname'";
          $dmconn = mysqli_query($conn, $dmq);
          if(mysqli_num_rows($dmconn) > 0){
             // if one or more rows are returned do following
          while ($results = mysqli_fetch_assoc($dmconn)){
            //i can see the groups from both if and else if conditions
            if ($results["userOne"] == $sessname) {  //what groups are usertwo in???
              $uTwo = $results["userTwo"]; //uname format
              //run query
              $sql = " SELECT * FROM membership where uname = '$uTwo' ";
              $sqlrun = mysqli_query($conn,$sql);
              //we want to grab the number of rows , then grab the group ids
                    if(mysqli_num_rows($sqlrun) > 0 ){
                      echo "Shout Hallelujah, it works";
                      // echo "<br>";
                    }
            }elseif ($results["userTwo"] == $sessname) {

              $uOne = $results["userOne"]; //uname form//the other user in the message
              // $depth = array();
              // $gList = array();
              //run query and exclude the global group
              $sql = " SELECT * FROM membership where uname = '$uOne' and not grpid = '6' Order by grpid ";
              $sqlrun = mysqli_query($conn,$sql);
              // echo "<br>";
              //if there are results we want the group id from the query
              if(mysqli_num_rows($sqlrun) > 0 ){
                while ($k = mysqli_fetch_assoc($sqlrun)) {
                  $groupID = $k['grpid'];
                  $gList[] = $groupID;//store all the group id in a list
                  }

                // now we want a query that will look to see if the session user is in
                // each group with SQL In function from the grpid array $gList
                $newgList = implode(", ",$gList);//make a new list with commas
                $gQuery = "SELECT * FROM membership where uname ='$sessname' and grpid IN ($newgList) "; //run query with new list
                $gqRun = mysqli_query($conn, $gQuery);
                if (mysqli_num_rows($gqRun) == 0) {
                  // if user is not in any groups, grab how many members are in each group
                  // run it again now to get the people in each group
                    $bam = " SELECT * FROM membership where uname = '$uOne' and not grpid = '6' Order by grpid ";
                    $bamrun = mysqli_query($conn,$bam);
                    //if there are results, we want the group id for the next query
                    if(mysqli_num_rows($bamrun) > 0 ){
                      while ($m = mysqli_fetch_assoc($bamrun)) {
                        $groupIDagain = $m['grpid'];// get grpid
                      // }
                         echo $quereM = "SELECT grpid,COUNT(*) from membership where grpid = '$groupIDagain' ";
                        $quereMRun = mysqli_query($conn, $quereM);
                        // echo "<br>";
                        if ($gose = mysqli_num_rows($quereMRun) > 0 ) {    //count the rows now
                             $groups_by_size= array();
                            // $g_id = array();
                            // $count = array();
                            while ($five = mysqli_fetch_assoc($quereMRun)) {
                              $groups_by_size = [$five['grpid'] => $five['COUNT(*)']];//gets me the closest result
                              // $groups_by_size = array($five['grpid'] => $five['COUNT(*)']);//gets me the closest result
                              // $groups_by_size_final = array_merge($groups_by_size, $groups_by_size);

                               // $groups_by_size[] = $five;//what books tell me to do
                              // $g_id = $five['grpid'];
                              // $count = $five['COUNT(*)'];
                              // $groups_by_size = array_push($groups_by_size,$groups_by_size);
                              // $groups_by_size = array($count=>$g_id);
                                 // $groups_by_size[]=array_push($groups_by_size,$g_id);
                                 // $groups_by_size[]=array_push($groups_by_size,$count);
                                 // $depth[] = $five;
                            }
                            echo "<br>";
                            echo "Array: ";
                            print_r($groups_by_size);
                            echo "<br>";
                            // echo "Array Merge: ";
                            // echo "<br>";
                            // print_r($groups_by_size_final);
                            // echo "<br>";
                            foreach ($groups_by_size as $key => $value) {
                              echo "Group ".$key." has ".$value." members";
                              echo "<br>";
                              // echo "groups_by_size array: max array column  ". array_column($groups_by_size,$value);
                            }
                          }
                      }
                      // echo "g_id:  ". print_r($g_id);
                      // $l_size=max(array_keys($groups_by_size));
                      // $l_group = $groups_by_size[$l_size];
                    } //end of if statement
                    echo "<br>";
                  }//end of if statement
                    }//end of if statement
                else {
                  echo "User is in a group";
                }
            }//end of else if statement
              //can we get the group id to go with it so we can link it to a join link
               else {
                 echo "What threads exists?";
               }
             }//end of while loop for thread query
           }//end of if loop for thread query




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
              }
                // echo "    ".$hello;
                  // echo "The number is: ".$hello;
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
                    //closing brackets
                  }
              // }
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
                  <input type="submit" name = "invitation">
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
         // print_r($l_group);
          // print_r($fiveD);
         //another if statement
         //which group has the most members again


                                   // print_r($fiveC);
                                   // echo "<br>";

                                    // $bam3 = " SELECT * FROM membership where uname = '$uOne' and not grpid = '6' Order by grpid ";
                                    // $bamrun3 = mysqli_query($conn,$bam3);
                                    //    //if there are results we want the group id from the query
                                    //    if(mysqli_num_rows($bamrun3) > 0 ){
                                    //      while ($mm = mysqli_fetch_assoc($bamrun3)) {
                                    //         $groupIDagain3 = $mm['grpid'];
                                    //         // echo "Group ".$mm['grpid']. " with ";
                                    //         // echo "<br>";
                                    //       }
                                    //     }
                                     //        $quereM3 = "SELECT COUNT(*) from membership where grpid = '$groupIDagain3' ";
                                     //        $quereMRun3 = mysqli_query($conn, $quereM3);
                                     // //count the rows now
                                     //         $fiveD = array();
                                     //         if ($gose3 = mysqli_num_rows($quereMRun3) > 0 ) {
                                     //             while ($five3 = mysqli_fetch_assoc($quereMRun3)) {
                                     //             $fiveD[] = $five3;
                                     //             // echo $five3['COUNT(*)'] ." members";
                                     //             // echo "<br>";
                                     //               }
                                     //             }
          ?>
         </div>
       </div>
     </main>
