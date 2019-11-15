<?php
require "header.php";
?>
<html>
  <body>
    <div class="container my-3 py-3 z-depth-1">
      <div class="jumbotron">
        <div class="col-auto">
          <p class="display-4">Group Management</p>
        </div>
        <p class="lead">Specific Group Management</p>
        <hr>
        <div class="col-auto">
          <div>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Student ID</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $i = 1;
                  foreach ($_SESSION['gMembers'] as $m) {
                    echo '<tr>
                            <th scope="row">'.$i.'</th>
                            <td>'.$m.'</td>
                          </tr>';
                    $i++;
                  }
                ?>
              </tbody>
          </table>
          </div>
          <br>
          <div>
            <div class="shadow-sm p-3 mb-5 bg-white rounded">
            <?php
              if ($_SESSION['count'] < 6) {
                echo '<p>The group has finalized '.$_SESSION['count'].' peer reviews.</p>';
                echo '<button class="btn btn-primary" name="reminderemail-submit" type="submit">Send Reminder Email</button>';
              } else if ($_SESSION['count'] == 6) {
                echo '<p>The group has finalzied all the peer reviews.</p>';
                echo '<button class="btn btn-primary" name="evalemail-submit" type="submit">Send Evaluation Overall Email</button>';
              }
            ?></div>

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
