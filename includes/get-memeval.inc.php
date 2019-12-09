<?php
  require 'dbh.inc.php';

  if (isset($_GET['memberToMark']) && !empty($_SESSION['userID'])){
    $mReview = array();
    $memberToMark = $_GET['memberToMark'];

    if (empty($_SESSION['userID']) || empty($memberToMark)) {
      header("Location: ../members.php?error=emptyfields".$userID);
      exit();
    } else {
      $sql = "SELECT rateValue,rateJustification,image,imagetype,finalized,FK_MarkedUserID FROM reviews WHERE (FK_Marker=? AND FK_MarkedUserID=?)";
      $stmt = mysqli_stmt_init($connection);

      if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("Location: ../members.php?error=sqlerror");
      } else {
        mysqli_stmt_bind_param($stmt, "ss", $_SESSION['userID'], $memberToMark);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
        {
          foreach ($row as $r)
          {
            array_push($mReview,$r);
          }
        }
      }
    }
  } else {
    header("Location: index.php");
    exit();
  }
?>
