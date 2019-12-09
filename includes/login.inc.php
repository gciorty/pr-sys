<?php
session_start();

if (isset($_POST['login-submit'])) { //check that the request comes from login-submit
  require 'dbh.inc.php';

  $userID = $_POST['userID'];
  $password = $_POST['pwd'];
  $captcha = $_POST['captcha'];

  if (empty($userID) || empty($password)) {
      header("Location: ../index.php?error=emptyfields");
      exit();
  } else {
      $sql = "SELECT * FROM users where userID=?;";
      $stmt = mysqli_stmt_init($connection);

      if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../index.php?error=sqlerror");
          exit();
      } else {
          mysqli_stmt_bind_param($stmt, "s", $userID);
          mysqli_stmt_execute($stmt);
          $result = mysqli_stmt_get_result($stmt);
          if ($row = mysqli_fetch_assoc($result)) {
              $pwdCheck = password_verify($password, $row['pwdUser']);
              if ($pwdCheck == false) {
                  header("Location: ../index.php?error=wrongpwd");
                  exit();
              } else if ($pwdCheck == true) {
                  session_start();
                  $_SESSION['userID'] = $row['userID'];
                  $_SESSION['groupID'] = $row['GroupID'];
                  header("Location: ../home.php?login=success");
                  exit();
              } else {
                  header("Location: ../index.php?error=wrongpwd");
                  exit();
              }
          } else {
              header("Location: ../index.php?error=nouser");
              exit();
          exit();
          }

      }
  }
} else {
  header("Location: ../index.php");
  exit();
}
?>
