<?php
session_start();

require 'dbh.inc.php';

if (isset($_POST['selectgroup-submit'])){
  if ($_SESSION['userID'] == 0) {
    $gMembers = array();
    $groupID = $_POST['groupToManage'];

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
              array_push($gMembers,$r);
          }
        }
        $_SESSION['$gMembers'] = $gMembers;
        header("Location: ../managegroup.php?");
        exit();
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
