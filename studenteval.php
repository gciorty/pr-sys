<?php
require "header.php";
?>
<html>
  <body>
    <div class="container my-3 py-3 z-depth-1">
      <div class="jumbotron">
        <div class="col-auto">
          <p class="display-4">Student Peer Reviews</p>
        </div>
        <p class="lead">Student finalized peer reviews for Student ID: <?php echo '<strong>'.$_SESSION['studentID'].'</strong>' ?></p>
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
                  if ($_SESSION['nReviews'] == 1) {
                    echo '<tr>
                            <th scope="row">1</th>
                            <td>'.$_SESSION['studentEval'][0].'</td>
                            <td>'.$_SESSION['studentEval'][1].'</td>
                            <td>'.htmlentities($_SESSION['studentEval'][2]).'</td>';
                    if (!empty($_SESSION['studentEval'][3])) {
                      echo '<td><img src="data:'.$_SESSION['studentEval'][4].';base64,'.$_SESSION['studentEval'][3].'" alt="image" width="50px" /></td>
                          </tr>';
                    } else if (empty($_SESSION['studentEval'][3])) {
                      echo '<td>N/A</td>
                          </tr>';
                    }
                  } else if ($_SESSION['nReviews'] == 2) {
                    echo '<tr>
                            <th scope="row">1</th>
                            <td>'.$_SESSION['studentEval'][0].'</td>
                            <td>'.$_SESSION['studentEval'][1].'</td>
                            <td>'.$_SESSION['studentEval'][2].'</td>';
                    if (!empty($_SESSION['studentEval'][3])) {
                      echo '<td><img src="data:'.$_SESSION['studentEval'][4].';base64,'.$_SESSION['studentEval'][3].'" alt="image" width="50px" /></td>
                          </tr>';
                    } else if (empty($_SESSION['studentEval'][3])) {
                      echo '<td>N/A</td>
                          </tr>';
                    }
                    echo '
                          <tr>
                            <th scope="row">2</th>
                            <td>'.$_SESSION['studentEval'][5].'</td>
                            <td>'.$_SESSION['studentEval'][6].'</td>
                            <td>'.$_SESSION['studentEval'][7].'</td>';
                    if (!empty($_SESSION['studentEval'][8])) {
                      echo '<td><img src="data:'.$_SESSION['studentEval'][9].';base64,'.$_SESSION['studentEval'][8].'" alt="image" width="50px" /></td>
                          </tr>';
                    } else if (empty($_SESSION['studentEval'][8])) {
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
                if (!is_nan($_SESSION['overallGrade'])) {
                  echo 'The overall peer reviews grade is: '.$_SESSION['overallGrade'];
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
