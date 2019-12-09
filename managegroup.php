<?php
require "header.php";
require "includes/get-groupmemstatus.inc.php";
?>
<html>
  <body>
    <div class="container my-3 py-3 z-depth-1">
      <div class="jumbotron">
        <div class="col-auto">
          <p class="display-4">Group Management</p>
        </div>
        <p class="lead">Submission Status of Group <?php echo $groupID;?></p>
        <hr>
        <div class="col-auto">
          <div>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Student ID</th>
                  <th scope="col">Student Email</th>
                  <th scope="col">Details</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $length = count($gMembers);
                  $line = 1;
                  for ($i = 0; $i < $length; $i = $i + 2) {
                    echo '<tr>
                               <th scope="row">'.$line.'</th>
                               <td>'.$gMembers[$i].'</td>
                               <td>'.$gMembers[$i+1].'</td>
                               <td>
                                <form action="studenteval.php" method="get" target="_parent">
                                  <input type="hidden" name="studentToEvaluate" value="'.$gMembers[$i].'">
                                  <button class="btn btn-light" name="selectstudent-submit" type="submit">View Details</button>
                                </form>
                               </td>
                             </tr>';
                    $line++;
                  }
                ?>
              </tbody>
          </table>
          </div>
          <br>
          <div>
            <div class="shadow-sm p-3 mb-5 bg-white rounded">
              <form name="emailForm" action="includes/sendemail.inc.php" method="post">
                <?php
                  if ($count < 6) {
                    echo '<p>The group has finalized <strong>'.$count.'</strong> out of 6 peer reviews.</p>';
                    echo '<button class="btn btn-primary" name="reminderemail-submit" type="submit" ">Send Reminder Email</button>';
                  } else if ($count == 6) {
                    echo '<p>The group has finalzied all the peer reviews.</p>';
                    echo '<button class="btn btn-primary" name="evalemail-submit" type="submit">Send Evaluation Overall Email</button>';
                  }
                ?>
              </form>
            </div>
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
