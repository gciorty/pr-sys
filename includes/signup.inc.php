<?php
session_start();
if (isset($_POST['signup-submit'])) { //check that the request comes from signup-submit
  require 'dbh.inc.php';

  $username = $_POST['uid'];
  $email = $_POST['email'];
  $password = $_POST['pwd'];
  $repeatPassword = $_POST['pwd-repeat'];
  $group = $_POST['group'];
  $captcha = $_POST['captcha'];

  if (empty($username) || empty($email )|| empty($password) || empty($repeatPassword) || empty($captcha) || empty($group)) {
      header("Location: ../signup.php?error=emptyfields&uid=".$username."&email=".$email);
      exit();
  }
  else if ($captcha != $_SESSION['digit']) {
      header("Location: ../signup.php?error=captchaerr");
      exit();
  }
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      header("Location: ../signup.php?error=invalidemailformat");
      exit();
  }
  else if (!preg_match("/^[0-9]{9,10}$/", $username)) {
      header("Location: ../signup.php?error=invalidUserID");
      exit();
  }
  else if (!preg_match("/((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{7,32})/", $password)) {
      header("Location: ../signup.php?error=passwordStrenght");
      exit();
  }
  else if ($password !== $repeatPassword) {
      header("Location: ../signup.php?error=pwdNotMatch");
      exit();
  }
  else {
      $sql = "SELECT userID FROM users WHERE userID=?";
      $stmt = mysqli_stmt_init($connection);
      if (!mysqli_stmt_prepare($stmt,$sql)) {
          header("Location: ../signup.php?error=sqlerror");
          exit();
      } else {
          mysqli_stmt_bind_param($stmt, "s", $username);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_store_result($stmt);
          $resultCheck = mysqli_stmt_num_rows($stmt);
          if ($resultCheck > 0) {
              header("Location: ../signup.php?error=usertaken&email=".$email);
              exit();
          } else {
              $sql = "SELECT userID FROM users WHERE GroupID=?";
              $stmt = mysqli_stmt_init($connection);
              if (!mysqli_stmt_prepare($stmt,$sql)) {
                  header("Location: ../signup.php?error=sqlerror");
                  exit();
              } else {
                mysqli_stmt_bind_param($stmt, "i", $group);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                if ($resultCheck >= 3) {
                    header("Location: ../signup.php?error=groupFull");
                    exit();
                } else {
                  $sql = "INSERT INTO users (userID, email, pwdUser, GroupID) VALUES (?, ?, ?, ?)";
                  $stmt = mysqli_stmt_init($connection);
                  if (! mysqli_stmt_prepare($stmt,$sql)) {
                      header("Location: ../signup.php?error=sqlerror");
                      exit();
                  } else {
                      $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                      mysqli_stmt_bind_param($stmt, "sssi", $username, $email, $hashedPwd, $group);
                      mysqli_stmt_execute($stmt);
                      header("Location: ../signup.php?signup=success");
                      exit();
                  }
                }
              }
          }
      }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($connection);
} else {
  header("Location: ../signup.php");
  exit();
}
?>
