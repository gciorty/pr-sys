<?php
require "header.php";
require "includes/get-studenteval.inc.php";
?>
<html>
  <body>
    <div class="container my-3 py-3 z-depth-1">
      <div class="jumbotron">
        <div class="col-auto">
          <p class="display-4">Student Peer Reviews</p>
        </div>
        <p class="lead">Student finalized peer reviews for Student ID: <?php echo '<strong>'.$studentID.'</strong>' ?></p>
        <hr>
        <div class="col-auto">
          <div>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Marked By</th>
                  <th scope="col">Rate Value</th>
                  <th scope="col">Rate Justification ID</th>
                  <th scope="col">Image</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if ($nReviews == 1) {
                    echo '<tr>
                            <th scope="row">1</th>
                            <td>'.$studentEval[0].'</td>
                            <td>'.$studentEval[1].'</td>
                            <td>'.htmlentities($studentEval[2]).'</td>';
                    if (!empty($studentEval[3])) {
                      echo '<td><img src="data:'.$studentEval[4].';base64,'.$studentEval[3].'" alt="image" width="50px" /></td>
                          </tr>';
                    } else if (empty($studentEval[3])) {
                      echo '<td>N/A</td>
                          </tr>';
                    }
                  } else if ($nReviews == 2) {
                    echo '<tr>
                            <th scope="row">1</th>
                            <td>'.$studentEval[0].'</td>
                            <td>'.$studentEval[1].'</td>
                            <td>'.htmlentities($studentEval[2]).'</td>';
                    if (!empty($studentEval[3])) {
                      echo '<td><img src="data:'.$studentEval[4].';base64,'.$studentEval[3].'" alt="image" width="50px" /></td>
                          </tr>';
                    } else if (empty($studentEval[3])) {
                      echo '<td>N/A</td>
                          </tr>';
                    }
                    echo '
                          <tr>
                            <th scope="row">2</th>
                            <td>'.$studentEval[5].'</td>
                            <td>'.$studentEval[6].'</td>
                            <td>'.htmlentities($studentEval[7]).'</td>';
                    if (!empty($studentEval[8])) {
                      echo '<td><img src="data:'.$studentEval[9].';base64,'.$studentEval[8].'" alt="image" width="50px" /></td>
                          </tr>';
                    } else if (empty($studentEval[8])) {
                      echo '<td>N/A</td>
                          </tr>';
                    }
                  }
                ?>
              </tbody>
          </table>
          </div>
            <hr>
            <div class="shadow-sm p-3 mb-5 bg-white rounded">
              <?php
                if (!is_nan($overallGrade)) {
                  echo 'The overall peer reviews grade is: '.$overallGrade;
                } else {
                  echo 'The student has not been marked yet.';
                }
              ?>
            </div>
          <div>
            <button class="btn btn-primary" name="goback-submit" onclick="goBack()">Go Back</button>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>

<?php
require "footer.php"
?>
