<?php
  require '../includes/dbh.inc.php';
  $result = '';
  for ($i = 1; $i <= 10; $i++ ){
    $GroupName = 'Group ' . $i;
    $sql = "INSERT INTO groups (GroupName, Approved) VALUES (? , 0)";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        echo 'Sql connetion error';
        exit();
    } else {
      mysqli_stmt_bind_param($stmt, "s", $GroupName);
      mysqli_stmt_execute($stmt);
      $result = $result . ' ' . $GroupName;
    }
  }
  echo $result;
?>
