<?php

require 'dbh.inc.php';

if (isset($_GET['groupToManage'])){
  if ($_SESSION['userID'] == "000000000") {
    $gMembers = array();
    $groupID = $_GET['groupToManage'];
    $sql = "SELECT userID,email FROM users WHERE GroupID=?";
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
              array_push($gMembers,$r);
          }
        }

        $sql = "SELECT COUNT(*) FROM reviews WHERE FK_Marker = ?;";
        $stmt = mysqli_stmt_init($connection);
        $count = 0;
        foreach ($gMembers as $m) {
          if ($m != "000000000"){
            if (!mysqli_stmt_prepare($stmt,$sql)) {
                echo 'Sql connetion error';
                exit();
            } else {
              mysqli_stmt_bind_param($stmt, "s", $m);
              mysqli_stmt_execute($stmt);
              $result = mysqli_stmt_get_result($stmt);
              $tmp = mysqli_fetch_array($result);
              $count += $tmp[0];
            }
          }
        }
        $_SESSION['gMembers'] = $gMembers;
    }
  } else {
    header("Location: ../index.php");
    exit();
  }
} else {
  header("Location: ../index.php");
  exit();
}
?>
