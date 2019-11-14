<?php

require 'dbh.inc.php';

if (isset($_SESSION['userID'])) {
  $groups = array();
  $sql = "SELECT DISTINCT GroupID FROM users where GroupID is not null";
  $stmt = mysqli_stmt_init($connection);

  if (!mysqli_stmt_prepare($stmt,$sql)) {
      echo 'Sql connetion error';
      exit();
  } else {
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
      {
        foreach ($row as $r)
        {
          array_push($groups,$r);
        }
      }
  }
} else {
  header("Location: ../index.php");
  exit();
}


?>
