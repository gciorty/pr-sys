<?php
session_start();

require 'dbh.inc.php';

if (isset($_POST['search-submit'])){
  if ($_SESSION['userID'] == 0) {
    $searchResults = array();
    $searchString = $_POST['searchString'];
    $searchType = $_POST['searchStudentBy'];

    $sql = "SELECT userID FROM users WHERE userID LIKE '%{$searchString}%' ";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt,$sql)) {
        echo 'Sql connetion error';
        exit();
    } else {
      mysqli_stmt_bind_param($stmt, "i", $searchString);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
      {
        foreach ($row as $r)
        {
            array_push($searchResults,$r);
        }
      }
      $_SESSION['searchResults'] = $searchResults;
      header("Location: ../search.php?");
    }
  }
}


?>
