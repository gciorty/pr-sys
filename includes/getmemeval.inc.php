<?php
  session_start();
  require 'dbh.inc.php';

  if (isset($_POST['selectmem-submit'])){
    $mReview = array();
    $_SESSION['memberToMark'] = $_POST['memberToMark'];

    if (empty($_SESSION['userID']) || empty($_SESSION['memberToMark'])) {
      header("Location: ../members.php?error=emptyfields".$userID);
      exit();
    } else {
      $sql = "SELECT rateValue,rateJustification,image,imagetype,finalized,FK_MarkedUserID FROM reviews WHERE (FK_Marker=? AND FK_MarkedUserID=?)";
      $stmt = mysqli_stmt_init($connection);

      if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("Location: ../members.php?error=sqlerror");
      } else {
        mysqli_stmt_bind_param($stmt, "ss", $_SESSION['userID'], $_SESSION['memberToMark']);
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
      $_SESSION['memberReview'] = $mReview;
      if ($_SESSION['memberReview'][4] == 0) {
        header("Location: ../memberreview.php");
      } else if ($_SESSION['memberReview'][4] == 1) {
        header("Location: ../home.php?error=finalized");
      }

    }
  } else {
    header("Location: ../index.php");
    exit();
  }
?>
