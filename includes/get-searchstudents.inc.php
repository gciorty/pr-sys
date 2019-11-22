<?php
session_start();

require 'dbh.inc.php';

if (isset($_POST['search-submit']) || isset($_POST['pageselect-submit'])){
  if ($_SESSION['userID'] == 0) {
    $searchResults = array();
    $searchString = $_POST['searchString'];
    $searchType = $_POST['searchStudentBy'];
    $itemPage = $_POST['itemPage'];
    if (isset($_POST['selectedPage'])) {
      $selectedPage = $_POST['selectedPage'];
    } else {
      $selectedPage = 1;
    }
    $startIndex = ($selectedPage * $itemPage) - $itemPage;

    if ($searchType == 'ID') {
      // fetch number of users
      $sql = "SELECT COUNT(*) FROM users WHERE userID LIKE '%{$searchString}%' ";
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
      $sql = "SELECT userID FROM users WHERE userID LIKE '%{$searchString}%' LIMIT ?,?";
      $stmt = mysqli_stmt_init($connection);

      if (!mysqli_stmt_prepare($stmt,$sql)) {
          echo 'Sql connetion error';
          exit();
      } else {
        mysqli_stmt_bind_param($stmt, "ss", $startIndex, $itemPage);
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
        $_SESSION['searchString'] = $searchString;
        $_SESSION['searchResults'] = $searchResults;
        $_SESSION['searchType'] = $searchType;
        $_SESSION['itemPage'] = $itemPage;
        $_SESSION['startIndex'] = $startIndex;
        $_SESSION['selectedPage'] = $selectedPage;
        header("Location: ../managestudents.php");
      }
    }

    if ($searchType == "higher" || $searchType == "lower") {
      $searchResults = array();
      $finalized = 1;
      // fetch user count with average higher or equal than
      if ($searchType == "higher") {
          $sql = "SELECT COUNT(*) FROM ( SELECT FK_MarkedUserID, avg(ratevalue) FROM reviews WHERE finalized=? group by FK_MarkedUserID HAVING AVG(ratevalue) >= ?) AS DerivedTableAlias";
      }
      if ($searchType == "lower") {
          $sql = "SELECT COUNT(*) FROM ( SELECT FK_MarkedUserID, avg(ratevalue) FROM reviews WHERE finalized=? group by FK_MarkedUserID HAVING AVG(ratevalue) < ?) AS DerivedTableAlias";
      }

      $stmt = mysqli_stmt_init($connection);

      if (!mysqli_stmt_prepare($stmt,$sql)) {
          header("Location: ../managestudents.php?error=sqlerror");
          exit();
      } else {
        mysqli_stmt_bind_param($stmt, "is", $finalized, $searchString);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
        {
          $_SESSION['resultPages'] = $row[0];
        }

        // fetch the actual users using itempage limit (fetches 5 items at the time from db)
        if ($searchType == "higher") {
          $sql = "SELECT FK_MarkedUserID, avg(ratevalue) FROM reviews WHERE finalized=? GROUP BY FK_MarkedUserID HAVING AVG(ratevalue) >= ? LIMIT ?,?;";
        }
        if ($searchType == "lower") {
          $sql = "SELECT FK_MarkedUserID, avg(ratevalue) FROM reviews WHERE finalized=? GROUP BY FK_MarkedUserID HAVING AVG(ratevalue) < ? LIMIT ?,?;";
        }

        $stmt = mysqli_stmt_init($connection);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("Location: ../managestudents.php?error=sqlerror");
            exit();
        } else {
          mysqli_stmt_bind_param($stmt, "isss", $finalized, $searchString, $startIndex, $itemPage);
          mysqli_stmt_execute($stmt);
          $result = mysqli_stmt_get_result($stmt);
          while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
          {
            foreach ($row as $r)
            {
              array_push($searchResults,$r);
            }
          }
        }
        //$_SESSION['resultPages'] = $resultCheck;
        $_SESSION['searchString'] = $searchString;
        $_SESSION['searchResults'] = $searchResults;
        $_SESSION['searchType'] = $searchType;
        $_SESSION['itemPage'] = $itemPage;
        $_SESSION['startIndex'] = $startIndex;
        $_SESSION['selectedPage'] = $selectedPage;
        header("Location: ../managestudents.php");
      }
    }
  }
} else {
  header("Location: ../managestudents.php?error=requestError");
}


?>
