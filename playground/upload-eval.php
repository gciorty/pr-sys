<?php
  require '../includes/dbh.inc.php';

  $rateValue = 10;
  $rateJustification = 'This is a good member 11111111111111111111111111111';
  $image = NULL;
  $finalized = 0;
  $marker = 12345678;
  $marking = 2232233;

  if (empty($rateValue) || empty($rateJustification )) {
      echo 'empty fields';
      exit();
  } else {
      $sql = "INSERT INTO reviews (rateValue, rateJustification, finalized, Marker, FK_MarkedUserID) VALUES (?, ?, ?, ?, ?)";
      $stmt = mysqli_stmt_init($connection);
      if (!mysqli_stmt_prepare($stmt,$sql)) {
          echo 'Sql Error';
          exit();
      } else {
        echo 'writing operation';
        mysqli_stmt_bind_param($stmt, "isiss", $rateValue, $rateJustification, $finalized, $marker, $marking);
        mysqli_stmt_execute($stmt);
        echo 'completed';
        exit();
      }
    }

?>
