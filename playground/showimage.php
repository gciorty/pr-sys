<?php
require '../includes/dbh.inc.php';

$sql = "SELECT type,image FROM images WHERE PK_ID=?";
$stmt = mysqli_stmt_init($connection);
if (!mysqli_stmt_prepare($stmt,$sql)) {
    echo 'Sql connetion error';
    exit();
} else {
  $img = 16;
  mysqli_stmt_bind_param($stmt, "i", $img);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($result);
  //header("Content-type: ".$row['type']);
  //echo base64_decode($row['image']);
  echo '<img src="data:'.$row['type'].';base64,'.$row['image'].'" alt="Red dot" />';
}

?>
