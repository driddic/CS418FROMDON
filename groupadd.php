        <?php
        session_start();
        include 'testconn.php';
        //require 'group.php';
        ///   query membership to validate
        ///
        ///   Adding member to Group from Group search
        ///
        ///
        if (isset($_POST['join'])) {


        $remotegrp= $_POST['groupid'];
        $name= $_POST['uname'];
        $id = $_POST['uid'];

        $sql = " SELECT * FROM membership WHERE userid ='".$id."'and grpid = '$remotegrp' ";
        echo $sql;
        echo "<br>";

        $result = mysqli_query($conn,$sql);
        echo mysqli_num_rows($result);
        echo "<br>";
        if(mysqli_num_rows($result) > 0) {
          echo "in group already";
          echo "<br>";
          echo $id;

           header("Location: group.php?notice=ingroupalready");
           exit();
         }

         //query for membership to add
        else {
          $insert = " INSERT INTO membership (grpid,userid,uname, active)
                      VALUES ('$remotegrp','$id','$name', '0'); ";
                      echo $insert;
                      //running sql query above
                      mysqli_query($conn, $insert);

                      header("Location:group.php?notice=goodjoin");
                      exit();
              }

        }

              //
        // if (isset($_POST['view'])) {
        //   // take user to group chat
        //   header("location: homepage.php?groupid=".$remotegrp["grpid"]."'");
        //   exit();
        //
        // }
