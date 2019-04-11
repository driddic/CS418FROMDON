<?php
include 'testconn.php';
            // find out the number of results stored in database
  $sql="SELECT * FROM tbl_comment WHERE grpid = 6 ORDER BY comment_id DESC";
  $result = mysqli_query($conn, $sql);
  $number_of_results = mysqli_num_rows($result);
  $results_per_page = 10;
  // determine number of total pages available
  $number_of_pages = ceil($number_of_results/$results_per_page);
  // determine which page number visitor is currently on
  if (!isset($_GET['page'])) {
    $page = 1;
  } else {
    $page = $_GET['page'];
  }
  // determine the sql LIMIT starting number for the results on the displaying page
  $this_page_first_result = ($page-1)*$results_per_page;
  // retrieve selected results from database and display them on page
   $sqlone="SELECT * FROM tbl_comment WHERE grpid = 6 ORDER BY comment_id DESC LIMIT ".$this_page_first_result.",".$results_per_page."";
   $result = mysqli_query($conn, $sqlone);
  while($row = mysqli_fetch_array($result)) {
    $output='<div class="panel panel-default">
              <div class="panel-heading">By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
               <div class="panel-body">'.$row["message"].'</div>
               <div class="panel-footer" align = "center">
               <form action= "add_comment.php" method="POST" id="reply_form">
                 <input type="text"align="right" name="reply" placeholder="Type reply..." size ="30">
                 <button type="submit" align ="left "class="btn btn-default reply" id="'.$row["comment_id"].'">Reply</button>
                 </form>

                 <button type="button" align ="left" class="btn btn-default reply"id="'.$row["comment_id"].'">CHEER</button>
                 <button type="button" align="left" class="btn btn-default reply"id="'.$row["comment_id"].'">BOO</button></div>

              </div>';
              if($row["parent_comment_id"] == 0)
              {
               $marginleft = 0;
              }
              else
              {
               $marginleft = $marginleft + 66;
              }
             //displaying output
             echo $output;
  }
  // display the links to the pages
  for ($page=1;$page<=$number_of_pages;$page++) {
    echo '<a href="new.php?page=' . $page . '">' . $page . '</a> ';
  }


 ?>
