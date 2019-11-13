<?php
require '../includes/dbh.inc.php';


if(isset($_POST["submit-img"])) {
  if (!$_FILES["fileToUpload"]["type"]){
    echo '<p>No image submitted</p>';
  } else {
    if ( !preg_match( '/gif|png|x-png|jpeg/', $_FILES['fileToUpload']['type']) ) {
     die('<p>Only browser compatible images allowed</p></body></html>');
    } else if ( $_FILES['fileToUpload']['size'] > 16384 ) {
     die('<p>Sorry file too large</p></body></html>');
    } else if ( !($handle = fopen ($_FILES['fileToUpload']['tmp_name'], "r")) ) {
     die('<p>Error opening temp file</p></body></html>');
    } else if ( !($image = fread ($handle, filesize($_FILES['fileToUpload']['tmp_name']))) ) {
     die('<p>Error reading temp file</p></body></html>');
    } else {
       fclose ($handle);
       // Commit image to the database
       $data = file_get_contents($_FILES['fileToUpload']['tmp_name']);
       $image = base64_encode($data);
       $sql = "INSERT INTO images (type, name, image) VALUES (?, ?, ?)";
       $stmt = mysqli_stmt_init($connection);
       if (!mysqli_stmt_prepare($stmt,$sql)) {
           echo 'Sql connetion error';
           exit();
       } else {
         mysqli_stmt_bind_param($stmt, "sss", $_FILES['fileToUpload']['type'], $_FILES['fileToUpload']['name'], $image);
         mysqli_stmt_execute($stmt);
         echo 'image uploaded';
       }
     }
    }
  }
?>
