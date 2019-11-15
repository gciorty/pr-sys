<?php

require 'dbh.inc.php';

if (isset($_SESSION['userID'])) {
  $groupMembers = array();
  $groupID = $_SESSION['groupID'];
  $sql = "SELECT userID FROM users WHERE GroupID=?";
  $stmt = mysqli_stmt_init($connection);

  if (!mysqli_stmt_prepare($stmt,$sql)) {
      echo 'Sql connetion error';
      exit();
  } else {
      mysqli_stmt_bind_param($stmt, "i", $groupID);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
      {
        foreach ($row as $r)
        {
          if ($r != $_SESSION['userID']){
            array_push($groupMembers,$r);
          }
        }
      }
  }
} else {
  header("Location: ../index.php");
  exit();
}


?>
