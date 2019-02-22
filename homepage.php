<?php
    session_start();
    require_once 'testconn.php';
    include 'header.php';
?>
<main>
  <head>
    <script src="https://code.jquery.com/jquery-3.3.1.js"
      integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
      crossorigin="anonymous"></script>
  </head>

    <!-- SIDEBAR -->
    <div id= "sidebar" class="w3-sidebar s3 w3-dark-blue w3-bar-block" style= "width:15%">
      <h3 class ="w3-bar-item">
         <?php
         $sessname = $_SESSION['username'];
         $sessid= $_SESSION['userid'];
          //check to see if user is logged in first
         if (isset($_SESSION['username'])){echo "Hello  " . $sessname." #".$sessid; }
            else { echo "not logged in";
                  header("Location: index.php?error=loginfirsthp");  }
           ?>
         </h3>
    <?php
      //listing groups the user is in
       $sql = "SELECT groups.grpname, groups.grpid
               FROM (( membership INNER JOIN users on membership.userid = users.userid)
               INNER JOIN groups on membership.grpid = groups.grpid)
               WHERE users.userid = '".$sessid."';";
       $show = mysqli_query($conn, $sql);
       if(mysqli_num_rows($show) > 0){
          // if one or more rows are returned do following
       while ($results = mysqli_fetch_assoc($show)){
       echo "<div>
            <a href='globalgroup.php?groupid=".$results["grpid"]."'
             name ='".$results["grpname"]."'
             class='w3-bar-item w3-button'>  ".$results["grpname"]."</a>
              </div>";
           }
           // echo "pass while"; $grpclick = $_POST[$results["grpid"]];
           // <input type ='button' id = 'mygroupdisplay' value=".$results["grpname"].">
         }
      ?>
    </div>
    <!-- MESSAGE BOARD -->
    <div style="margin-left:15% ">
     <div id = "groupcontent" class="w3-container w3-grey w3-center">
       <?php
         //include 'globalgroup.php?groupid='.$results["grpid"];
         include 'globalgroup.php';
        ?>
   </div>
<script type="text/javascript">
       $(document).ready(function(){
      //alert('form loaded');
      //change the text
      $("#mygroupdisplay").click(function(){
        $("#groupcontent").html("hello there");
      });
    });
</script>
  </body>
</main>
