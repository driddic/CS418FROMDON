
<?php
session_start();
require 'testconn.php';
include 'header.php';


  // code...
    $query = $_POST['query'];
    // gets value sent over search form
        $query = htmlspecialchars($query);
        // changes characters used in html to their equivalents, for example: < to &gt;
        $query = mysqli_real_escape_string($conn, $query);
        // makes sure nobody uses SQL injection
        $raw_results = mysqli_query($conn,"SELECT * FROM `users` WHERE (`uname` LIKE '%".$query."%')") or die(mysqli_error($conn));

   if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following
     echo "<div id = 'bigbox'>
            <h1 align = center> Search Results</h1>";
            while($results = mysqli_fetch_array($raw_results)){
              //  I want pictures up there too so check this out
              $reid = $results["userid"];

              $sqlmg =" SELECT * FROM profileimage WHERE userid = '$reid' ";
              $resultmg = mysqli_query($conn, $sqlmg);
              while ($rowmg = mysqli_fetch_assoc($resultmg)){


                  if ($rowmg['status'] == 0) { //put a class on it
                          echo "<img src = 'assets/profile".$reid.".jpg' class='avatar'>";
                          echo "<img src = 'assets/profile".$reid.".png'class='avatar'>";
                          echo "  <p><h3><a href='profile.php?uid=".$results["userid"]."'name ='".$results["uname"]."'>  ".$results["uname"]."</a></h3></p>
                                  <p>".$results['fname']." ".$results['lname']."</p>";
                  }else {
                    echo "<img src = 'assets/profile.png' class='avatar'>";
                    echo "  <p><h3><a href='profile.php?uid=".$results["userid"]."'name ='".$results["uname"]."'>  ".$results["uname"]."</a></h3></p>
                            <p>".$results['fname']." ".$results['lname']."</p>";
                  }}

            }
            echo "</div>";
          }

        else{ // if there is no matching rows do following
            echo "No results";
        }
        ?>
