<?php
  session_start();
  require 'dbh.inc.php';

  if (isset($_POST['delete-review'])){
    if(!empty($_SESSION['memberReview'])){
      if (empty($_SESSION['userID']) || empty($_SESSION['memberToMark'])) {
        header("Location: ../members.php?error=emptyfields".$userID);
        exit();
      } else {
        $sql = "DELETE FROM reviews WHERE (FK_Marker=? AND FK_MarkedUserID=?)";
        $stmt = mysqli_stmt_init($connection);

        if (!mysqli_stmt_prepare($stmt,$sql)) {
          header("Location: ../members.php?error=sqlerror");
        } else {
          mysqli_stmt_bind_param($stmt, "ss", $_SESSION['userID'], $_SESSION['memberToMark']);
          mysqli_stmt_execute($stmt);
          header("Location: ../home.php?success=reviewdeleted");
        }
      }
    } else {
      header("Location: ../memberreview.php?error=reviewnotexists");
    }
  } else {
    header("Location: ../index.php");
    exit();
  }
?>
