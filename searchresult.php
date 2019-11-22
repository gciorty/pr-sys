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
      if(!empty($_SESSION['searchResults']) && $_SESSION['searchType'] == "allstudents"){
        if (isset($_GET['page'])) {
          $selectedPage = $_GET['page'];
        }
        $pages = 0;
        for ($i = 0; $i < $_SESSION['resultPages']; $i++) {
          if ($i % $_SESSION['itemPage'] == 0) {
            $pages++;
          }
        }
        if ($_SESSION['searchType'] == "allstudents") {
          echo '<h3>Viewing All Students</h3>';
        }

        echo '<br>
              <nav aria-label="page-nav">
                <ul class="pagination">
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1">Page: </a>
                </li>';
        for ($i = 0; $i < $pages; $i++) {
          $page = $i + 1;
          if (isset($_SESSION['selectedPage'])){
            if ($_SESSION['selectedPage'] == $page){
              echo  '<li class="page-item">
                      <form action="includes/get-allstudents.inc.php" method="post" target="_parent">
                        <input type="hidden" name="selectedPage" value="'.$page.'">
                        <button class="btn btn-dark" name="pageselect-submit" type="submit">'.$page.'</button>
                    </form></li>';
            } else {
              echo  '<li class="page-item">
                      <form action="includes/get-allstudents.inc.php" method="post" target="_parent">
                        <input type="hidden" name="selectedPage" value="'.$page.'">
                        <button class="btn btn-light" name="pageselect-submit" type="submit">'.$page.'</button>
                    </form></li>';
            }
          } else {
            echo  '<li class="page-item">
                    <form action="includes/get-allstudents.inc.php" method="post" target="_parent">
                      <input type="hidden" name="selectedPage" value="'.$page.'">
                      <button class="btn btn-light" name="pageselect-submit" type="submit">'.$page.'</button>
                  </form></li>';
          }
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
        for ($i = 0 ; $i <= $_SESSION['itemPage']; $i++) {
            if (!empty($_SESSION['searchResults'][$i])) {
              $line = $i + 1 + $_SESSION['startIndex'];
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

      } else if (!empty($_SESSION['searchResults']) && $_SESSION['searchType'] == "ID"){
          if (isset($_GET['page'])) {
            $selectedPage = $_GET['page'];
          }
          $pages = 0;
          for ($i = 0; $i < $_SESSION['resultPages']; $i++) {
            if ($i % $_SESSION['itemPage'] == 0) {
              $pages++;
            }
          }
          if ($_SESSION['searchType'] == "ID") {
            echo '<h3>Viewing Search by ID: "'.$_SESSION['searchString'].'" </h3>';
          }
          echo '<br>
                <nav aria-label="page-nav">
                  <ul class="pagination">
                  <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Page: </a>
                  </li>';
          for ($i = 0; $i < $pages; $i++) {
            $page = $i + 1;
            if (isset($_SESSION['selectedPage'])){
              if ($_SESSION['selectedPage'] == $page){
                echo  '<li class="page-item">
                        <form action="includes/get-searchstudents.inc.php" method="post" target="_parent">
                          <input type="hidden" name="selectedPage" value="'.$page.'">
                          <input type="hidden" name="searchString" value="'.$_SESSION['searchString'].'">
                          <input type="hidden" name="searchStudentBy" value="'.$_SESSION['searchType'].'">
                          <input type="hidden" name="itemPage" value="'.$_SESSION['itemPage'].'">
                          <button class="btn btn-dark" name="pageselect-submit" type="submit">'.$page.'</button>
                      </form></li>';
              } else {
                echo  '<li class="page-item">
                        <form action="includes/get-searchstudents.inc.php" method="post" target="_parent">
                          <input type="hidden" name="selectedPage" value="'.$page.'">
                          <input type="hidden" name="searchString" value="'.$_SESSION['searchString'].'">
                          <input type="hidden" name="searchStudentBy" value="'.$_SESSION['searchType'].'">
                          <input type="hidden" name="itemPage" value="'.$_SESSION['itemPage'].'">
                          <button class="btn btn-light" name="pageselect-submit" type="submit">'.$page.'</button>
                      </form></li>';
              }
            } else {
              echo  '<li class="page-item">
                      <form action="includes/get-searchstudents.inc.php" method="post" target="_parent">
                        <input type="hidden" name="selectedPage" value="'.$page.'">
                        <input type="hidden" name="searchString" value="'.$_SESSION['searchString'].'">
                        <input type="hidden" name="searchStudentBy" value="'.$_SESSION['searchType'].'">
                        <input type="hidden" name="itemPage" value="'.$_SESSION['itemPage'].'">
                        <button class="btn btn-light" name="pageselect-submit" type="submit">'.$page.'</button>
                    </form></li>';
            }


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
          for ($i = 0 ; $i <= $_SESSION['itemPage']; $i++) {
              if (!empty($_SESSION['searchResults'][$i])) {
                $line = $i + 1 + $_SESSION['startIndex'];
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
        } else if (!empty($_SESSION['searchResults']) && ($_SESSION['searchType'] == "higher" || $_SESSION['searchType'] == "lower")) {
            if (isset($_GET['page'])) {
              $selectedPage = $_GET['page'];
            }
            $pages = 0;
            for ($i = 0; $i < $_SESSION['resultPages']; $i++) {
              if ($i % $_SESSION['itemPage'] == 0) {
                $pages++;
              }
            }
            if ($_SESSION['searchType'] == "higher") {
              echo '<h3>Viewing Students with grade higher or equal than: '.$_SESSION['searchString'].'</h3>';
            }
            if ($_SESSION['searchType'] == "lower") {
              echo '<h3>Viewing Students with grade lower than: '.$_SESSION['searchString'].'</h3>';
            }
            echo '<br>
                  <nav aria-label="page-nav">
                    <ul class="pagination">
                    <li class="page-item disabled">
                      <a class="page-link" href="#" tabindex="-1">Page: </a>
                    </li>';
            for ($i = 0; $i < $pages; $i++) {
              $page = $i + 1;
              if (isset($_SESSION['selectedPage'])){
                if ($_SESSION['selectedPage'] == $page){
                  echo  '<li class="page-item">
                          <form action="includes/get-searchstudents.inc.php" method="post" target="_parent">
                            <input type="hidden" name="selectedPage" value="'.$page.'">
                            <input type="hidden" name="searchString" value="'.$_SESSION['searchString'].'">
                            <input type="hidden" name="searchStudentBy" value="'.$_SESSION['searchType'].'">
                            <input type="hidden" name="itemPage" value="'.$_SESSION['itemPage'].'">
                            <button class="btn btn-dark" name="pageselect-submit" type="submit">'.$page.'</button>
                        </form></li>';
                } else {
                  echo  '<li class="page-item">
                          <form action="includes/get-searchstudents.inc.php" method="post" target="_parent">
                            <input type="hidden" name="selectedPage" value="'.$page.'">
                            <input type="hidden" name="searchString" value="'.$_SESSION['searchString'].'">
                            <input type="hidden" name="searchStudentBy" value="'.$_SESSION['searchType'].'">
                            <input type="hidden" name="itemPage" value="'.$_SESSION['itemPage'].'">
                            <button class="btn btn-light" name="pageselect-submit" type="submit">'.$page.'</button>
                        </form></li>';
                }
              } else {
                echo  '<li class="page-item">
                        <form action="includes/get-searchstudents.inc.php" method="post" target="_parent">
                          <input type="hidden" name="selectedPage" value="'.$page.'">
                          <input type="hidden" name="searchString" value="'.$_SESSION['searchString'].'">
                          <input type="hidden" name="searchStudentBy" value="'.$_SESSION['searchType'].'">
                          <input type="hidden" name="itemPage" value="'.$_SESSION['itemPage'].'">
                          <button class="btn btn-light" name="pageselect-submit" type="submit">'.$page.'</button>
                      </form></li>';
              }
            }
            echo '    <li class="page-item disabled">
                        <button class="btn btn-light" onclick="sortTable(1)">Sort Grades</button>
                      </li>
                    </ul>
                  </nav>';
                  echo '<table class="table table-hover" id="gradeTable">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Student ID</th>
                              <th scope="col">Average Grade</th>
                              <th scope="col">Details</th>
                            </tr>
                          </thead>
                          <tbody>';
                  $lenghtArr = count($_SESSION['searchResults']);
                  $line =   $_SESSION['startIndex'];
                  for ($i = 0 ; $i <= $lenghtArr; $i++) {
                      if (!empty($_SESSION['searchResults'][$i])) {
                        $line++;
                        echo ' <tr>
                                   <th scope="row">'.$line.'</th>
                                   <td>'.$_SESSION['searchResults'][$i].'</td>
                                   <td>'.$_SESSION['searchResults'][$i+1].'</td>
                                   <td>
                                    <form action="includes/get-studenteval.inc.php" method="post" target="_parent">
                                      <input type="hidden" name="studentToEvaluate" value="'.$_SESSION['searchResults'][$i].'">
                                      <button class="btn btn-light" name="selectstudent-submit" type="submit">View Details</button>
                                    </form>
                                   </td>
                                 </tr>';
                      }
                      $i++;
                  }
                  echo '</tbody>
                            </table>';
        } else {
          echo '<div class="alert-light" role="alert">
                  Click show all students or perform search to show results.
                </div>';
        }
    ?>
  </div>
</body>
</html>
