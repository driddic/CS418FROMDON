<?php
include 'testconn.php';
$xmlDoc=new DOMDocument();
$xmlDoc->load("botslash.xml");

$x=$xmlDoc->getElementsByTagName('command');

//get the q parameter from URL
$q=$_GET["q"];

//lookup all links from the xml file if length of q>0
if (strlen($q)>0) {
  $hint="";
  for($i=0; $i<($x->length); $i++) {
    $y=$x->item($i)->getElementsByTagName('slash');
    $z=$x->item($i)->getElementsByTagName('example');
    $a = $x->item($i)->getElementsByTagName('work');
    if ($y->item(0)->nodeType==1) {
      //find a link matching the search text
      if (stristr($y->item(0)->childNodes->item(0)->nodeValue,$q)) {

        if ($hint=="") {
          $hint= '<b>'.$y->item(0)->childNodes->item(0)->nodeValue.'</b> <i> '.$z->item(0)->childNodes->item(0)->nodeValue.
          '</i> <br>
          '.$a->item(0)->childNodes->item(0)->nodeValue.'<br>' ;
        } else {
          $hint=$hint .'<b>'.$y->item(0)->childNodes->item(0)->nodeValue.'</b> <i> '.$z->item(0)->childNodes->item(0)->nodeValue.
          '</i> <br>
          '.$a->item(0)->childNodes->item(0)->nodeValue.'<br>' ;
        }
      }
    }
  }
}

// Set output to "" if no hint was found
// or to the correct values
if ($hint=="") {
  $response="There is no such command";
} else {
  $response=$hint;
}

//output the response
echo $response;
?>
