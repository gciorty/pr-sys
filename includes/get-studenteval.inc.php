<?php

require 'dbh.inc.php';

if (isset($_GET['studentToEvaluate'])){
  if ($_SESSION['userID'] == "000000000") {
    $studentEval = array();
    $studentID = $_GET['studentToEvaluate'];
    $finalized = 1;
    $nReviews = 0;
    $sql = "SELECT FK_Marker, rateValue, rateJustification, image, imagetype FROM reviews WHERE (FK_MarkedUserID = ? AND finalized = ?)";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt,$sql)) {
        echo 'Sql connetion error';
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "si", $studentID, $finalized);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
        {
          foreach ($row as $r)
          {
              array_push($studentEval,$r);
          }
          $nReviews++;
        }
        if ($nReviews == 2 ) {
          $overallGrade = ($studentEval[1] + $studentEval[6]) / $nReviews;
        } else if ($nReviews == 1 ){
          $overallGrade = $studentEval[1];
        } else {
          $overallGrade = 0;
        }
    }
  } else {
    header("Location: ../index.php");
    exit();
  }
} else {
  header("Location: ../index.php");
  exit();
}

?>
