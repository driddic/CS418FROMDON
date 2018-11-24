<?php
session_start();
require 'testconn.php';
include 'header.php';

    $query = $_POST['query'];
    // gets value sent over search form
        $query = htmlspecialchars($query);
        // changes characters used in html to their equivalents, for example: < to &gt;
        $query = mysqli_real_escape_string($conn, $query);
        // makes sure nobody uses SQL injection

        $raw_results = mysqli_query($conn,"SELECT * FROM `users` WHERE (`uname` LIKE '%".$query."%')") or die(mysqli_error($conn));
      //  $raw_results_again = mysqli_query($conn, "SELECT * FROM `groups` WHERE (`grpname` = '%".$query."%')") or die(mysqli_error($conn));
        //test query
        // echo "this is query: " .$query;
        if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following
            while($results = mysqli_fetch_array($raw_results)){
              echo "<div id = 'login-box'><p>Here is: <h3>".$results['uname']."</h3></p></div>";
            }
          }

        else{ // if there is no matching rows do following
            echo "No results";
        }
