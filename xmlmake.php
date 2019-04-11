<?php
include 'testconn.php';
// include 'header.php';
/** create XML file */
// $mysqli = new mysqli("localhost", "root", "", "dbbookstore");
// /* check connection */
// if ($mysqli->connect_errno) {
//    echo "Connect failed ".$mysqli->connect_error;
//    exit();
// }
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
