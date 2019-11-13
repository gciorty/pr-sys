<?php
session_start();

if (isset($_POST['review-form'])) {
  require 'dbh.inc.php';

  $rateValue = $_POST['rating'];
  $rateJustification = $_POST['ratejus'];
  $deleteImage = $_POST['deleteImage'];
  $image;
  $imagetype;
  $finalized = $_POST['finalizeMark'];
  $marker = $_SESSION['userID'];
  $markedUserID = $_POST['selectedUser'];

if ($deleteImage == 1) {
  $image = NULL;
  $imagetype = NULL;
} else if (!$_FILES["fileToUpload"]["type"]){
  echo '<p>No image submitted</p>';
  } else {
    if ( !preg_match( '/gif|png|x-png|jpeg/', $_FILES['fileToUpload']['type']) ) {
     header("Location: ../memberreview.php?error=errorFormat");
     exit();
    } else if ( $_FILES['fileToUpload']['size'] > 16384 ) {
     header("Location: ../memberreview.php?error=fileLarge");
     exit();
    } else if ( !($handle = fopen ($_FILES['fileToUpload']['tmp_name'], "r")) ) {
     header("Location: ../memberreview.php?error=filerror1");
     exit();
    } else if ( !($image = fread ($handle, filesize($_FILES['fileToUpload']['tmp_name']))) ) {
     header("Location: ../memberreview.php?error=filerror2");
     exit();
    } else {
     fclose ($handle);
     // Prep image to add to the database
     $data = file_get_contents($_FILES['fileToUpload']['tmp_name']);
     $image = base64_encode($data);
     $imagetype = $_FILES['fileToUpload']['type'];
   }
}


if (empty($rateValue) || empty($rateJustification) || empty($marker) || empty($markedUserID)) {
    header("Location: ../memberreview.php?error=emptyfield".$rateValue.$rateJustification.$marker.$markedUserID);
    exit();
} else {
  $sql = "SELECT PK_ID FROM reviews WHERE (FK_Marker=? AND FK_MarkedUserID=?)";
  $stmt = mysqli_stmt_init($connection);
  if (!mysqli_stmt_prepare($stmt,$sql)) {
    header("Location: ../memberreview.php?error=sqlerror");
    exit();
  } else {
    mysqli_stmt_bind_param($stmt, "ss", $_SESSION['userID'], $_SESSION['memberToMark']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $resultCheck = mysqli_stmt_num_rows($stmt);
    if ($resultCheck > 0) {
      $sql = "UPDATE reviews SET rateValue=? , rateJustification=?, image=?, imagetype=?, finalized=? WHERE (FK_Marker=? AND FK_MarkedUserID=?);";
      $stmt = mysqli_stmt_init($connection);
      if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("Location: ../memberreview.php?error=sqlerror");
        exit();
      } else {
        if ($finalized == NULL) {
          $finalized = 0;
        }
        mysqli_stmt_bind_param($stmt, "isssiss", $rateValue, $rateJustification, $image, $imagetype, $finalized, $marker, $markedUserID );
        mysqli_stmt_execute($stmt);
        header("Location: ../home.php?success");
        exit();
      }
    } else {
      $sql = "INSERT INTO reviews (rateValue, rateJustification, image, imagetype,  finalized, FK_Marker, FK_MarkedUserID) VALUES (?, ?, ?, ?, ?, ?, ?)";
      $stmt = mysqli_stmt_init($connection);
      if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("Location: ../memberreview.php?error=sqlerror");
        exit();
      } else {
        if ($finalized == NULL) {
          $finalized = 0;
        }
        mysqli_stmt_bind_param($stmt, "isssiss", $rateValue, $rateJustification, $image, $imagetype,  $finalized, $marker, $markedUserID );
        mysqli_stmt_execute($stmt);
        header("Location: ../home.php?success");
        exit();
      }
    }
  }
  }
} else {
  header("Location: ../index.php?error=invalidaccess");
}

?>
