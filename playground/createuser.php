<?php
  require '../includes/dbh.inc.php';

  $username = '456456456';
  $email = 'pippo@gmail.com';
  $password = 'Test123!';
  $group = 1;

  $sql = "INSERT INTO users (userID, email, pwdUser, FK_GroupID) VALUES (?, ?, ?, ?)";
  $stmt = mysqli_stmt_init($connection);
  if (!mysqli_stmt_prepare($stmt,$sql)) {
      echo 'Sql connetion error';
      exit();
  } else {
      $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

      mysqli_stmt_bind_param($stmt, "sssi", $username, $email, $hashedPwd, $group);
      mysqli_stmt_execute($stmt);

      echo 'user created';
  }

?>
