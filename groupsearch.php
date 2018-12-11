<?php

require 'testconn.php';
include_once 'group.php';

    if (isset($_POST['grpsearch'])) {
      // code...

    $query = $_POST['grpsearch'];
    // gets value sent over search form
        $query = htmlspecialchars($query);
        // changes characters used in html to their equivalents, for example: < to &gt;
        $query = mysqli_real_escape_string($conn, $query);
        // makes sure nobody uses SQL injection

        //inner join maybe
        $sql = "SELECT * From groups
         WHERE (grpname LIKE '%".$query."%')";
      //  $raw_results = mysqli_query($conn,"SELECT * FROM `users` WHERE (`uname` LIKE '%".$query."%')") or die(mysqli_error($conn));

      //  $raw_results_again = mysqli_query($conn, "SELECT * FROM `groups` WHERE (`grpname` = '%".$query."%')") or die(mysqli_error($conn));
        //test query
        // echo "this is query: " .$query;
        $rawresults = mysqli_query($conn,$sql);
}
        // if(mysqli_num_rows($sql) > 0){ // if one or more rows are returned do following
        //     while($results = mysqli_fetch_array($sql)){
        //       echo "<div id = 'bigbox'>
        //               <p><h3>".$results['uname']."</h3></p>
        //               <p>".$results['fname']." ".$results['lname']."</p>
        //             </div>";
        //     }
        //   }
        //
        // else{ // if there is no matching rows do following
        //     echo "No results";
        // }
