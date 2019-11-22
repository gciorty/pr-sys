<?php
session_start();

require 'dbh.inc.php';

if ($_SESSION['userID'] == "000000000") {
  $searchResults = array();
  $itemPage = 5;

  if (isset($_POST['selectedPage'])) {
    $selectedPage = $_POST['selectedPage'];
  } else {
    $selectedPage = 1;
  }
  $startIndex = ($selectedPage * 5) - 5;

  // fetch number of users
  $sql = "SELECT COUNT(*) FROM users";
  $stmt = mysqli_stmt_init($connection);

  if (!mysqli_stmt_prepare($stmt,$sql)) {
      header("Location: ../managestudents.php?error=sqlerror");
      exit();
  } else {
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
    {
      $_SESSION['resultPages'] = $row[0];
    }
  }

  // fetch userIDs
  $tutorID = "000000000";
  $sql = "SELECT userID FROM users WHERE userID != ? LIMIT ?,?";
  $stmt = mysqli_stmt_init($connection);

  if (!mysqli_stmt_prepare($stmt,$sql)) {
    echo 'Sql connetion error';
    exit();
  } else {
      mysqli_stmt_bind_param($stmt, "sss", $tutorID, $startIndex, $itemPage);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
      {
        foreach ($row as $r)
        {
          if ($r != 0){
            array_push($searchResults,$r);
          }
        }
      }
      $_SESSION['searchType'] = "allstudents";
      $_SESSION['searchResults'] = $searchResults;
      $_SESSION['itemPage'] = $itemPage;
      $_SESSION['startIndex'] = $startIndex;
      $_SESSION['selectedPage'] = $selectedPage;
      header("Location: ../managestudents.php");
  }
}
?>
