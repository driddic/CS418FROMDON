<?php
  // Create database connection
  $db = mysqli_connect("localhost", "root", "", "university");

  // Initialize message variable
  $msg = "";

  // Get image name

  // If upload button is clicked ...
   if (isset($_POST['upload'])){
  	$image = $_FILES['image']['name'];
  	// Get text
  	$image_text = mysqli_real_escape_string($db, $_POST['image_text']);
  	// image file directory
  	$target = "images/".basename($image);
    $uid= $_POST['usernum'];
    $name=$_POST['user'];

   $sql = "INSERT INTO images (image, image_text, uid, user_mess, grp) VALUES ('$image', '$image_text','$uid','$name','$fire')";
  	// execute query
  	mysqli_query($db, $sql);
  	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}}
  $result = mysqli_query($db, "SELECT * FROM `images` WHERE grpid='$fire' ORDER BY `images`.`id`  DESC" );
?>

<!DOCTYPE html>
<html>
<head>
<title>Image Upload</title>
<!--
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
-->
<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<style type="text/css">
   #content{
   	width: 50%;
   	margin: 20px auto;
   	border: 1px solid #cbcbcb;
   }
   form{
   	width: 50%;
   	margin: 20px auto;
   }
   form div{
   	margin-top: 5px;
   }
   #img_div{
   	width: 80%;
   	padding: 5px;
   	margin: 15px auto;
   	border: 1px solid #cbcbcb;
   }
   #img_div:after{
   	content: "";
   	display: block;
   	clear: both;
   }
   img{
   	float: left;
   	margin: 5px;
   	width: 300px;
   	height: 140px;
   }
</style>
</head>
<body>
<div style="width:15%">
  <div id= "sidebar" class="w3-sidebar s3 w3-dark-blue w3-bar-block" style= "width:15%">
    <h3 class ="w3-bar-item">
       <?php
       $adminNum = '9';
       $sessid = '1';
       // $sessname = $_SESSION['username'];
       // $sessid= $_SESSION['userid'];
       //  //check to see if user is logged in first
       // if (isset($_SESSION['username'])){echo "Hello  " . $sessname." #".$sessid; }
       //    else { echo "not logged in";
       //          header("Location: index.php?error=loginfirsthp");  }
         ?>
       </h3>
       <form class="" action="homepage.php" method="post">
         <input type="text" name="opensearch" placeholder="OpenSearch for all posts">
           <input type="submit" name="opens" value="Search">
         </form>
    <!-- //listing groups the user is in -->
    <h4>Groups</h4>

    <?php
    if ($sessid == $adminNum) {
          $seegroup = "SELECT grpname, grpid FROM groups ";
          $show = mysqli_query($db, $seegroup);
          if(mysqli_num_rows($show) > 0){
             // if one or more rows are returned do following
          while ($resultsm = mysqli_fetch_assoc($show)){

          echo "<div>
               <a href='index.php?groupid=".$resultsm["grpid"]."'name ='".$resultsm["grpname"]."'class='w3-bar-item w3-button'>  ".$resultsm
               ["grpname"]."</a>
                 </div>";

              }
            }
    }elseif($sessid !== $adminNum) {
      $sql = "SELECT groups.grpname, groups.grpid
              FROM (( membership INNER JOIN users on membership.userid = users.userid)
              INNER JOIN groups on membership.grpid = groups.grpid)
              WHERE users.userid = '".$sessid."'
              and membership.active = 0
              and groups.archive = 0;";
  //            echo $sql;
      $show = mysqli_query($db, $sql);
      if(mysqli_num_rows($show) > 0){
         // if one or more rows are returned do following
      while ($results = mysqli_fetch_assoc($show)){
        echo "<div>
             <a href='index.php?groupid=".$results["grpid"]."'name ='".$results["grpname"]."'class='w3-bar-item w3-button'>  ".$results["grpname"]."</a>
             </div>";  // code...
             $groupTitle = $results["grpname"];
          }
        }
    }
else {
echo "no code";
}
    ?>
  </div>
</div>
  <div style="margin-left:15%">

<?php $fire=$_GET["groupid"]; ?>
<div id="content">
  <form id="testboy" method="POST" action="index.php" enctype="multipart/form-data">
    <input type="hidden" name="size" value="1000000">
    <div>
      <input type="file" name="image">
    </div>
    <div>
      <textarea
      id="text"
      cols="40"
      rows="4"
      name="image_text"
      placeholder="Say something about this image..."></textarea>
      <input type="hidden" name="usernum" value="5">
      <input type="hidden" name="user" value="homeboy">
      <input type="hidden" name="user" value="<?php echo $fire; ?>">
    </div>
    <div>
      <button type="submit" name="upload">POST</button>
    </div>
  </form>
  <?php
    while ($row = mysqli_fetch_array($result)) {
      echo "<div id='img_div'>";
        if (empty($row['image'])) {
          // code...

        }else {
          // code...
          echo "<img src='images/".$row['image']."' >";
        }
      	echo "<p>".$row['image_text']."</p>";
      echo "</div>";
    }
  ?>
</div>
</div>
</body>
</html>
<script type="text/javascript">
$('#testboy').on('submit', function(event){
 event.preventDefault();
 var form_data = $(this).serialize();
 $.ajax({
  url:"index.php",
  method:"POST",
  data:form_data,

  success:function(data)
  {
    if(data.error != '')
   {
    $('#comment_form')[0].reset();
    $('#comment_message').html(data.error);
    $('#comment_id').val('0');
    load_comment();
  }
 }
 })
});
</script>
