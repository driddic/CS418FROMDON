<?php

require "init.php";
include 'testconn.php';

$data = fetchData();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signed In</title>
</head>
<body style="margin-top: 200px; text-align: center;">
    <div>
        <?php
        if (!isset($_SESSION['user'])) {
            header("location: index.php");
        }
        //test output
        var_dump($_SESSION['payload']);
        echo "<br>";
        echo "<br>";
        //more test output
        echo "username: ". $_SESSION['user'] ;
        echo "<br>";
        echo "email: ". $_SESSION['email']['email'] ;
        echo "<br>";
        //i tested the output to see what I was going
        //to use and initialize
        $user = $_SESSION['user'];
        $gitEmail = $_SESSION['email']['email'];

        //is the session user is set?

        if (isset($_SESSION['user'])) {

          //if so check to see if the user is already in the db
          $doubleCheck = "SELECT * FROM users where uname = '$user' ";
          $runDCheck = mysqli_query($conn,$doubleCheck);

          if (mysqli_num_rows($runDCheck) > 0) {
            if ($row = mysqli_fetch_assoc($runDCheck))   {
                        //if true start a session here
                      //
                      session_start();
                      $_SESSION['userid'] = $row['userid'];
                      $_SESSION['username'] = $row['uname'];
                      // $_SESSION['password'] = $row['pwd'];

                      //$_SESSION['logged_in']= true;

                      //for testing
                     // header("Location: homepage.php");
                      //for real(2FA)
                     header("Location: authenic.php");
                      exit();
            }
            else { //incase of a mistake , safe case
                  Header("Location: index.php?error=noacct");
                  exit();
                }
          }
          else {
            // we want that user to be placed into the db
          echo "<br>";
          echo "<br>";

          echo $insertDB = "INSERT INTO users (userid,fname,lname,uname,email,pword,git)
                            VALUES (' ', ' ', ' ', '$user', '$gitEmail', ' ', 1);";
           $insertRun = mysqli_query($conn, $insertDB);
           echo "<br>";

          echo "good insert: " .$insertRun;

          if ($insertRun)
           {
             $last_id = mysqli_insert_id($conn);
             echo "New record created successfully. Last inserted ID is: " . $last_id;
             echo "<br>";

           }
           //'''place new users in global group automatically ''' 6 = sportscenter
           $sqlthr= "INSERT INTO membership (grpid,userid, uname) VALUES (6,'".$last_id."', '$user');";

            echo "inserted membership";
            echo "<br>";

           $scoreagain = mysqli_query($conn, $sqlthr);
           $sqlfive = "INSERT INTO profileimage (locate, userid, status) VALUES ('assets/profile.png','$last_id', '1');";
           echo "image set";
           $scored = mysqli_query($conn, $sqlfive);

           //update the xml user file for up to date user logs
           function createXMLfile($usersArray){

              $filePath = 'names.xml';
              $dom     = new DOMDocument('1.0', 'utf-8');
              $root      = $dom->createElement('users');
              for($i=0; $i<count($usersArray); $i++){

                $bookId        =  $usersArray[$i]['userid'];
                $bookName = htmlspecialchars($usersArray[$i]['fname']);
                $bookAuthor    =  $usersArray[$i]['lname'];
                $bookPrice     = $usersArray[$i]['uname'];

                $book = $dom->createElement('user');
                $bid     = $dom->createElement('id', $bookId);
                $book->appendChild($bid);
                $name     = $dom->createElement('Firstname', $bookName);
                $book->appendChild($name);
                $author   = $dom->createElement('Lastname', $bookAuthor);
                $book->appendChild($author);
                $price    = $dom->createElement('Username', $bookPrice);
                $book->appendChild($price);
                // $isbn     = $dom->createElement('ISBN', $bookISBN);
                // $book->appendChild($isbn);
                // $category = $dom->createElement('category', $bookCategory);
                // $book->appendChild($category);

                $root->appendChild($book);
              }
              $dom->appendChild($root);
              $dom->save($filePath);
            }
            //XML creation
            $query = "SELECT * FROM users";
           $usersArray = array();
           if ($result = $conn->query($query)) {
               /* fetch associative array */
               while ($row = $result->fetch_assoc()) {
                  array_push($usersArray, $row);
               }

               if(count($usersArray)){
                    createXMLfile($usersArray);
                }
               /* free result set */
               $result->free();
           }
           /* close connection */
           $conn->close();
          //XML end

          //start a session
          session_start();
          $_SESSION['userid'] = $last_id;
          $_SESSION['username'] = $user;
           //forward to homepage
           // Header("location: homepage.php");
           //for 2FA
           header("Location: authenic.php");

           exit();
          }
        }


        ?>

        <a href="logout.php">Log Out</a>
    </div>
</body>
</html>
