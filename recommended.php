<?php
//this is the recommended group ideas
// if a user is in a direct message with one they are not in a group with,
// recommend the group with the largest member list for each conversation
//get conversations.
// echo "string";
$dmq = "SELECT Distinct * FROM messagecontrol WHERE userOne = '$sessname' or userTwo = '$sessname'";
$dmconn = mysqli_query($conn, $dmq);
if(mysqli_num_rows($dmconn) > 0){
   // if one or more rows are returned do following
while ($results = mysqli_fetch_assoc($dmconn)){
  //i can see the groups from both if and else if conditions
  if ($results["userOne"] == $sessname) {  //what groups are usertwo in???
    $uTwo = $results["userTwo"]; //uname format

                  // $uOne = $results["userOne"]; //uname form//the other user in the message
                  // $depth = array();
                  // $gList = array();
                  //run query and exclude the global group
                  $sql = " SELECT * FROM membership where uname = '$uTwo' and not grpid = '6' Order by grpid ";
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
                        $bam = "select grpid, count(*) as NewCount from membership WHERE grpid in(1,5,12,13) group by grpid ";
                        $bamrun = mysqli_query($conn,$bam);
                        $new_groups =array();
                        //if there are results, we want the group id for the next query
                        if(mysqli_num_rows($bamrun) > 0 ){
                          while ($m = mysqli_fetch_assoc($bamrun)) {
                            $groupIDagain = $m['grpid'];// get grpid
                            array_push($new_groups,$m);
                          }

                        $biggestGroup = -1;
                        $biggestCount = -1;
                        foreach($new_groups as $theElement){
                           if($theElement['NewCount'] > $biggestCount){

                            $biggestGroup = $theElement['grpid'];
                            $biggestCount = $theElement['NewCount'];
                             // echo "grpid";
                               $theElement['grpid'];
                             // echo "NewCount";
                              $theElement['NewCount'];
                             // echo "<br>";
                           }

                        }
                        // echo "the biggestCount:  ". $biggestCount." the biggest grp : ".$biggestGroup;
                        $final_query = "SELECT * From groups where grpid = $biggestGroup";
                        $final_run = mysqli_query($conn,$final_query);

                        if (mysqli_num_rows($final_run)>0) {
                          while ($result = mysqli_fetch_assoc($final_run)) {
                            // echo "<br>";
                            // echo " Want to join this Group?:  ";
                            // echo $result['grpname'];
                            if ($result['access'] == 'public') {
                                echo "
                                      <p><h3>".$result['grpname']."</h3> Owner: ".$result['owner']."</p>
                                      <form action='groupadd.php' method ='post'>
                                      <input type='hidden' name= 'groupid' value='".$result['grpid']."'>
                                      <input type='hidden' name= 'uname' value='".$sessname."'>
                                      <input type='hidden' name= 'uid' value='".$sessid."'>
                                      <button type='submit' name='join'>Join</button>
                                      </form>
                                    ";
                                  }
                            else {
                              echo "<p><h3>".$result['grpname']."</h3></p>
                                    <p>".$result['owner']."</p>
                                    <form action='groupadd.php' method ='post'>
                                    <input type='hidden' name= 'groupid' value='".$result['grpid']."'>
                                    <input type='hidden' name= 'uname' value='".$sessname."'>
                                    <input type='hidden' name= 'uid' value='".$sessid."'>
                                    <button type='submit' name='request'>Request</button>
                                    </form>
                                  ";
                                }
                          }
                        }

                        }
                        echo "<br>";
                      }//end of if statement
                        }//end of if statement
                    else {
                      echo " ";
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
          $bam = "select grpid, count(*) as NewCount from membership WHERE grpid in(1,5,12,13) group by grpid ";
          $bamrun = mysqli_query($conn,$bam);
          $new_groups =array();
          //if there are results, we want the group id for the next query
          if(mysqli_num_rows($bamrun) > 0 ){
            while ($m = mysqli_fetch_assoc($bamrun)) {
              $groupIDagain = $m['grpid'];// get grpid
              array_push($new_groups,$m);

            }
          // print_r($m);
          // echo "<br>";
          // print_r($new_groups);
          $biggestGroup = -1;
          $biggestCount = -1;
          foreach($new_groups as $theElement){
             if($theElement['NewCount'] > $biggestCount){

              $biggestGroup = $theElement['grpid'];
              $biggestCount = $theElement['NewCount'];
              // echo "grpid";
                 $theElement['grpid'];
               // echo "NewCount";
                $theElement['NewCount'];
               // echo "<br>";
             }

          }
          // echo "the biggestCount:  ". $biggestCount." the biggest grp : ".$biggestGroup;
          $final_query = "SELECT * From groups where grpid = $biggestGroup";
          $final_run = mysqli_query($conn,$final_query);

          if (mysqli_num_rows($final_run)>0) {
            while ($result = mysqli_fetch_assoc($final_run)) {
              // echo "<br>";
              // echo " Want to join this Group?:  ";
              // echo $result['grpname'];
              if ($result['access'] == 'public') {
                  echo "
                        <p><h3>".$result['grpname']."</h3> Owner: ".$result['owner']."</p>
                        <form action='groupadd.php' method ='post'>
                        <input type='hidden' name= 'groupid' value='".$result['grpid']."'>
                        <input type='hidden' name= 'uname' value='".$sessname."'>
                        <input type='hidden' name= 'uid' value='".$sessid."'>
                        <button type='submit' name='join'>Join</button>
                        </form>
                      ";
                    }
              else {
                echo "<p><h3>".$result['grpname']."</h3></p>
                      <p>".$result['owner']."</p>
                      <form action='groupadd.php' method ='post'>
                      <input type='hidden' name= 'groupid' value='".$result['grpid']."'>
                      <input type='hidden' name= 'uname' value='".$sessname."'>
                      <input type='hidden' name= 'uid' value='".$sessid."'>
                      <button type='submit' name='request'>Request</button>
                      </form>
                    ";
                  }
            }
          }

          }
          echo "<br>";
        }//end of if statement
          }//end of if statement
      else {
        echo " ";
      }
  }//end of else if statement
    //can we get the group id to go with it so we can link it to a join link
     else {
       echo "What threads exists?";
     }
   }//end of while loop for thread query
 }//end of if loop for thread query



 ?>
