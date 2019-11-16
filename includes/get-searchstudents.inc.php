<?php
session_start();

require 'dbh.inc.php';

if (isset($_POST['search-submit'])){
  if ($_SESSION['userID'] == 0) {
    $searchResults = array();
    $searchString = $_POST['searchString'];
    $searchType = $_POST['searchStudentBy'];

    if ($searchType == 'ID') {
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
            if ($r != 0){
              array_push($searchResults,$r);
            }
          }
        }
        $_SESSION['searchResults'] = $searchResults;
        $_SESSION['searchType'] = $searchType;
        $_SESSION['itemPage'] = $_POST['itemPage'];
        header("Location: ../search.php?");
      }
    }
    if ($searchType == "higher" || $searchType == "lower") {
      $students = array();
      $sql = "SELECT userID FROM users WHERE userID NOT IN (0)";
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
              array_push($students,$r);
            }
          }
          $finalized = 1;
          $sql = "SELECT rateValue FROM reviews WHERE FK_MarkedUserID=? AND finalized=?";
          $stmt = mysqli_stmt_init($connection);

          if (!mysqli_stmt_prepare($stmt,$sql)) {
              echo 'Sql connetion error';
              exit();
          } else {
            foreach ($students as $student) {
              $nReviews = 0;
              $studentEval = array();
              mysqli_stmt_bind_param($stmt, "ii", $student, $finalized);
              mysqli_stmt_execute($stmt);
              $result = mysqli_stmt_get_result($stmt);

              while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
              {
                foreach ($row as $r)
                {
                    array_push($studentEval,$r);
                }
                $nReviews++;
              }
              $overallGrade = ($studentEval[0] + $studentEval[1]) / $nReviews;
              $sValue = (int)$searchString;
              if ($searchType == "higher") {
                if ($overallGrade >= $sValue) {
                  array_push($searchResults, $student);
                  array_push($searchResults, $overallGrade);
                }
              }
              if ($searchType == "lower") {
                if ($overallGrade < $sValue) {
                  array_push($searchResults, $student);
                  array_push($searchResults, $overallGrade);
                }
              }
            }
            $_SESSION['searchResultsGrade'] = $searchResults;
            $_SESSION['searchType'] = $searchType;
            $_SESSION['itemPage'] = $_POST['itemPage'];
            header("Location: ../search.php?");
          }
      }
    }
  }
}


?>
