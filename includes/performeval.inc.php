<?php
session_start();

if (isset($_POST['review-form'])) {
  require 'dbh.inc.php';

  $rateValue = $_POST['rating'];
  $rateJustification = $_POST['ratejus'];
  $image = NULL;
  $finalized = $_POST['finalizeMark'];
  $marker = $_SESSION['userID'];
  $markedUserID = $_POST['selectedUser'];

  if (empty($rateValue) || empty($rateJustification) || empty($marker) || empty($markedUserID)) {
      header("Location: ../members.php?error=emptyfield".$rateValue.$rateJustification.$marker.$markedUserID);
      exit();
  } else {
    $sql = "INSERT INTO reviews (rateValue, rateJustification, finalized, FK_Marker, FK_MarkedUserID) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt,$sql)) {
      header("Location: ../members.php?error=sqlerror");
      exit();
    } else {
      if ($finalized == NULL) {
        $finalized = 0;
      }
      mysqli_stmt_bind_param($stmt, "isiss", $rateValue, $rateJustification, $finalized, $marker, $markedUserID );
      mysqli_stmt_execute($stmt);
      header("Location: ../members.php?success");
      exit();
    }
  }
} else {
    header("Location: ../index.php?error=invalidaccess");
}

?>
