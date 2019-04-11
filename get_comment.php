<main>
  <head>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
<body>

  <?php

  //fetch_comment.php
  include 'testconn.php';
  //$connect = new PDO('mysql:host=localhost;dbname=testing', 'root', '');
  $currentgroup = 6;
  $query = " SELECT * FROM tbl_comment
              WHERE parent_comment_id = '0' and grpid = '$currentgroup'
              ORDER BY comment_id DESC ";
  $sabbath = mysqli_query($conn, $query);
  // $statement = $conn->prepare($query);
  // $statement->execute();
  $output = '';
  while ($row = mysqli_fetch_assoc($sabbath)) {
  // $result = $statement->fetchAll();
  // foreach($result as $row){
   $output .= '
   <div class="panel panel-default">
    <div class="panel-heading">By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
    <div class="panel-body">'.$row["message"].'</div>
    <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Reply</button></div>
   </div>
   ';
   $output .= get_reply_comment($conn);
  }

  echo $output;

  function get_reply_comment($conn, $parent_id = 0, $marginleft = 0, $currentgroup = 6){
  $query = " SELECT * FROM tbl_comment
              WHERE parent_comment_id = '$parent_id'
              and grpid= '$currentgroup' ";
   $output = '';
   $sabbathsec = mysqli_query($conn, $query);
   // $statement = $conn->prepare($query);
   // $statement->execute();
   // $output = '';
   // $statement = $conn->prepare($query);
   // $statement->execute();
   // $result = $statement->fetchAll();
   $count= mysqli_num_rows($sabbathsec);
   // $count = $statement->rowCount();


    $marginleft = $marginleft + 48;

   if($count > 0) {
     while ($row = mysqli_fetch_assoc($sabbathsec)) {

     $output .= '
     <div class="panel panel-default" style="margin-left:'.$marginleft.'px">
      <div class="panel-heading">By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
      <div class="panel-body">'.$row["message"].'</div>
      <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Reply</button></div>
     </div>
     ';
     $output .= get_reply_comment($conn, $row["comment_id"], $marginleft, $currentgroup);
    }
   } return $output;
  }
?>
</body>
</main>
