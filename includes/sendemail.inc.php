<?php
session_start();

if (isset($_POST['reminderemail-submit'])){
  if($_SESSION['userID'] == 0) {
    $length = count($_SESSION['gMembers']);
    $subject = 'Peer Review Submission Reminder';
    $message = 'Please login to the Peer Review System and submit your members evaluation.';
    $headers = 'From: sigfilippoberio@gmail.com';
    for ($i = 1; $i < $length; $i = $i + 2) {
      $to_email = $_SESSION['gMembers'][$i];
      mail($to_email,$subject,$message,$headers);
    }
    header("Location: ../home.php?success=reminderSent");
  }
} else if (isset($_POST['evalemail-submit'])) {
  if($_SESSION['userID'] == 0) {
    require 'dbh.inc.php';
    $membersAverage = array();
    $length = count($_SESSION['gMembers']);

    $sql = "SELECT SUM(rateValue) FROM reviews WHERE (FK_MarkedUserID = ?)";
    $stmt = mysqli_stmt_init($connection);

    for ($i = 0; $i < $length; $i = $i + 2) {
      if (!mysqli_stmt_prepare($stmt,$sql)) {
          echo 'Sql connetion error';
          exit();
      } else {
          mysqli_stmt_bind_param($stmt, "i", $_SESSION['gMembers'][$i]);
          mysqli_stmt_execute($stmt);
          $result = mysqli_stmt_get_result($stmt);
          $tmp = mysqli_fetch_array($result);
          $avg = $tmp[0]/2;
          array_push($membersAverage,"Student ID: ".$_SESSION['gMembers'][$i]." - Average Overview: ".strval($avg));
      }
    }
    $length = count($_SESSION['gMembers']);
    $subject = 'Peer Review Submission Overall';
    $message = join("\r\n",$membersAverage);
    $headers = 'From: sigfilippoberio@gmail.com';
    for ($i = 1; $i < $length; $i = $i + 2) {
      $to_email = $_SESSION['gMembers'][$i];
      mail($to_email,$subject,$message,$headers);
    }
    header("Location: ../home.php?success=overallSent");
  }
}

?>
