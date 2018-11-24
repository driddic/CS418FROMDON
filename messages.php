<!DOCTYPE HTML>
<html>
<head><style>.error {color: #FF0000;}</style>
</head>
<body>
 <?php
      session_start();
      date_default_timezone_set("America/New_York");
      include 'testconn.php';
      include 'postmessages.php';
      $comment = "";
      $commenterror = "";
      $arrival = new DateTime();
      $arrivalString = $arrival->format("Y-m-d H:i:s");

      if ($_SERVER["REQUEST_METHOD"] == "POST")
      {
        if (isset($_POST['commentsSubmit'])) {

          if (empty($_POST["comment"])) {//if field is empty
            $commenterror = "Comment is required";
            header("location: homepage.php?error=noinput");
            exit();
          }

          else {
            //initialize and run function test input
            $comment = test_input($_POST["comment"]);

          }

          }
        }
      //test input for htmlspecialchars, removes backslashes and newlines, tabs, and extra space
      function test_input($data)
      {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

  ?>

<!--form-->
<?php
echo "<form method='POST' action='".setComments($conn)."'>
  <input type='hidden' name='user' value='".$_SESSION['uname']."'>
  <input type='hidden' name='timestamp' value='".date('Y-m-d H:i:s')."'>
   <textarea name='comment' rows='5' cols='80'></textarea>
   <p><span class='error'>$commenterror</span></p>
    <button align = center type='submit' name='commentsSubmit' value='Submit'>Post</button>
</form>
";

?>

<?php
if (isset($_POST['commentsSubmit'])) {
  echo "<h2>Your Input:</h2>";
  echo $comment ;
  echo "</br>";
  echo $arrivalString;
}

?>

</body>
</html>
