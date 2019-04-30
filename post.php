<?php 
if(isset($_POST["image_url"]))
{
 $message = '';
 $image = '';
 if(filter_var($_POST["image_url"], FILTER_VALIDATE_URL))
 {
  $allowed_extension = array("jpg", "png", "jpeg", "gif");
  $url_array = explode("/", $_POST["image_url"]);
  $image_name = end($url_array);
  $image_array = explode(".", $image_name);
  $extension = end($image_array);
  if(in_array($extension, $allowed_extension))
  {
   $image_data = file_get_contents($_POST["image_url"]);
   $new_image_path = "upload/" . rand() . "." . $extension;
   file_put_contents($new_image_path, $image_data);
   $message = 'Image Uploaded';
   $image = '<img src="'.$new_image_path.'" class="img-responsive img-thumbnail"  />';
  }
  else
  {
   $message = "Image not found";
  }
 }
 else
 {
  $message = 'Invalid Url';
 }
 $output = array(
  'message' => $message,
  'image'  => $image
 );
 echo json_encode($output);
}
