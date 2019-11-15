<?php
require "header.php";
?>


<html>
<body>
  <div class="container my-3 py-3 z-depth-1">
    <div class="jumbotron">
      <div class="col-auto">
        <p class="display-4">Search</p>
      </div>
      <p class="lead">In this area you can search students by ID or by grade<small> (shows only student enrolled to the system)</small></p>
      <hr>
      <div class="col-auto">
        <form class="form-inline" name="SearchForm" action="includes/get-searchstudents.inc.php" method="post">
          <select class="custom-select mr-sm-1" name="searchStudentBy" id="selectSearchStudent"  >
            <option selected value="ID">Search by ID</option>
            <option value="higher">Search by grade higher than..</option>
            <option value="lower">Search by grade lower than..</option>
          </select>
          <input type="text" name="searchString" class="form-control" placeholder="Search" aria-label="Recipient's username" aria-describedby="basic-addon2">
          <button class="btn btn-outline-secondary" name="search-submit" type="submit">Search</button>
        </form>
      </div>
      <hr>
    <div class="col-auto">
      <?php

        if (!empty($_SESSION['searchResults'])){
          echo '<table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Student ID</th>
                    </tr>
                  </thead>
                  <tbody>';
                  $length = count($_SESSION['searchResults']);
                  $line = 1;
          foreach ($_SESSION['searchResults'] as $s) {
            echo ' <tr>
                       <th scope="row">'.$line.'</th>
                       <td>'.$s.'</td>
                     </tr>';
            $line++;
          }
          echo '</tbody>
              </table>';
        }
      ?>
    </div>
    </div>
  </div>
</body>
</html>

<?php
require "footer.php"
?>
