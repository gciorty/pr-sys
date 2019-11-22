<?php
session_start();
?>
<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8">
  <meta name="description" content="web searches">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  <script>
  function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("gradeTable");
    switching = true;
    // Set the sorting direction to ascending:
    dir = "asc";
    /* Make a loop that will continue until
    no switching has been done: */
    while (switching) {
      // Start by saying: no switching is done:
      switching = false;
      rows = table.rows;
      /* Loop through all table rows (except the
      first, which contains table headers): */
      for (i = 1; i < (rows.length - 1); i++) {
        // Start by saying there should be no switching:
        shouldSwitch = false;
        /* Get the two elements you want to compare,
        one from current row and one from the next: */
        x = rows[i].getElementsByTagName("TD")[n];
        y = rows[i + 1].getElementsByTagName("TD")[n];
        /* Check if the two rows should switch place,
        based on the direction, asc or desc: */
        if (dir == "asc") {
          if (Number(x.innerHTML) > Number(y.innerHTML)) {
            // If so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
          }
        } else if (dir == "desc") {
          if (Number(x.innerHTML) < Number(y.innerHTML)) {
            // If so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
          }
        }
      }
      if (shouldSwitch) {
        /* If a switch has been marked, make the switch
        and mark that a switch has been done: */
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
        // Each time a switch is done, increase this count by 1:
        switchcount ++;
      } else {
        /* If no switching has been done AND the direction is "asc",
        set the direction to "desc" and run the while loop again. */
        if (switchcount == 0 && dir == "asc") {
          dir = "desc";
          switching = true;
        }
      }
    }
  }
  </script>

</head>

<body>
  <div class="col-auto">
    <?php
        if (!empty($_SESSION['itemPage'])){
          $itemPage = $_SESSION['itemPage'];
        } else {
          $itemPage = 5;
        }

        if (!empty($_SESSION['searchResults']) && ($_SESSION['searchType'] == "ID")){
          $resultCount = count($_SESSION['searchResults']);
          $pages = 0;
          for ($i = 0; $i < $resultCount; $i++) {
            if ($i % $itemPage == 0) {
              $pages++;
            }
          }
          echo '<br>
                <nav aria-label="page-nav">
                  <ul class="pagination">
                  <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Page: </a>
                  </li>';
          for ($i = 0; $i < $pages; $i++) {
            $page = $i + 1;
            echo  '<li class="page-item"><a class="page-link" href="searchresult.php?page='.$page.'">'.$page.'</a></li>';
          }
          echo '  </ul>
                </nav>';
          echo '<table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Student ID</th>
                      <th scope="col">Details</th>
                    </tr>
                  </thead>
                  <tbody>';
          $selectedPage = 1;
          if (isset($_GET['page'])) {
            $selectedPage = $_GET['page'];
          }
          $lastitem = $selectedPage * $itemPage;
          $startVal = $lastitem - $itemPage;
          for ($i = $startVal ; $i < $lastitem; $i++) {
              if (!empty($_SESSION['searchResults'][$i])) {
                $line = $i + 1;
                echo ' <tr>
                           <th scope="row">'.$line.'</th>
                           <td>'.$_SESSION['searchResults'][$i].'</td>
                           <td>
                            <form action="includes/get-studenteval.inc.php" method="post" target="_parent">
                              <input type="hidden" name="studentToEvaluate" value="'.$_SESSION['searchResults'][$i].'">
                              <button class="btn btn-light" name="selectstudent-submit" type="submit">View Details</button>
                            </form>
                           </td>
                         </tr>';
              }
          }
          echo '</tbody>
              </table>';
      }
      if (!empty($_SESSION['searchResultsGrade']) && ($_SESSION['searchType'] != "ID")) {
        $studentIDs = array();
        $overallGrades = array();
        $resultCount = count($_SESSION['searchResultsGrade']);
        for ($i = 0; $i < $resultCount; $i++) {
          if ($i % 2 == 0) {
            array_push($studentIDs, $_SESSION['searchResultsGrade'][$i]);
          } else if ($i % 2 != 0) {
            array_push($overallGrades, $_SESSION['searchResultsGrade'][$i]);
          }
        }
        $resultCount = count($studentIDs);
        $pages = 0;
        for ($i = 0; $i < $resultCount; $i++) {
          if ($i % $itemPage == 0) {
            $pages++;
          }
        }
        echo '<br>
              <nav aria-label="page-nav">
                <ul class="pagination">
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1">Page: </a>
                </li>';
        for ($i = 0; $i < $pages; $i++) {
          $page = $i + 1;
          echo  '<li class="page-item"><a class="page-link" href="searchresult.php?page='.$page.'">'.$page.'</a></li>';
        }
        echo '    <li class="page-item disabled">
                    <button class="btn btn-light" onclick="sortTable(1)">Sort Grades</button>
                  </li>
                </ul>
              </nav>';
        echo '<table class="table table-hover" id="gradeTable" >
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Student ID</th>
                    <th scope="col">Grade</th>
                    <th scope="col">Details</th>
                  </tr>
                </thead>
                <tbody>';
        $selectedPage = 1;
        if (isset($_GET['page'])) {
          $selectedPage = $_GET['page'];
        }
        $lastitem = $selectedPage * $itemPage;
        $startVal = $lastitem - $itemPage;
        for ($i = $startVal ; $i < $lastitem; $i++) {
            if (!empty($studentIDs[$i])) {
              $line = $i + 1;
              echo ' <tr>
                         <th scope="row">'.$line.'</th>
                         <td>'.$studentIDs[$i].'</td>
                         <td>'.$overallGrades[$i].'</td>
                         <td>
                          <form action="includes/get-studenteval.inc.php" method="post" target="_parent">
                            <input type="hidden" name="studentToEvaluate" value="'.$studentIDs[$i].'">
                            <button class="btn btn-light" name="selectstudent-submit" type="submit">View Details</button>
                          </form>
                         </td>
                       </tr>';
            }
        }
        echo '</tbody>
            </table>';
      }
      $studentIDs = array();
      $overallGrades = array();
    ?>
  </div>
</body>
</html>
