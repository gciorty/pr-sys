<?php
  require '../includes/dbh.inc.php';

  $users = array();
  $groupID = 1;
  $sql = "SELECT userID FROM users WHERE FK_GroupID=?";
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
                array_push($users,$r);
            }

        }
  }

  foreach ($users as $a) {
    echo $a;
  }


?>
