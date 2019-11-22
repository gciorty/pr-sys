<?php

require 'dbh.inc.php';

$availGroups = array();
$sql = "SELECT COUNT(*) from users  WHERE GroupID = ?";
$stmt = mysqli_stmt_init($connection);

if (!mysqli_stmt_prepare($stmt,$sql)) {
    echo 'Sql connetion error';
    exit();
} else {
    for ($i = 1; $i <= 10; $i++) {
      mysqli_stmt_bind_param($stmt, "i", $i);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
      {
        foreach ($row as $r)
        {
          if ($r < 3) {
            array_push($availGroups,$i);
          }
        }
      }
    }
}

?>
