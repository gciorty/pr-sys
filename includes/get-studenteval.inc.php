<?php
session_start();

require 'dbh.inc.php';

if (isset($_POST['selectstudent-submit'])){
  if ($_SESSION['userID'] == 0) {
    $studentEval = array();
    $studentID = $_POST['studentToEvaluate'];
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
        $_SESSION['studentEval'] = $studentEval;
        $_SESSION['nReviews'] = $nReviews;

        $_SESSION['overallGrade'] = ($studentEval[1] + $studentEval[6]) / $nReviews;

        $_SESSION['studentID'] = $studentID;
        header("Location: ../studenteval.php");
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
