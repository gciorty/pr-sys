<?php
require "header.php";
require "includes/get-activestudents.php"
?>

<body>
<html>
  <div class="container my-3 py-3 z-depth-1">
    <div class="jumbotron">
      <div class="col-auto">
        <p class="display-4">Student Management</p>
      </div>
      <p class="lead">In this area you can select the student and see details<small> (shows only student enrolled to the system)</small></p>
      <hr>
      <div class="col-auto">
      <form name="memberListForm" action="includes/get-studenteval.php" method="post">
        <div>
          <select class="custom-select mr-sm-1" name="studentToEvaluate" id="inlineFormCustomSelect"  >
            <option selected>Select student to manage</option>
            <?php
              foreach ($students as $s) {
                echo '<option value="'.$s.'">ID: '.$s.'</option>';
              }
            ?>
          </select>
        </div>
        <br>
        <div>
          <button class="btn btn-primary" name="selectstudent-submit" type="submit">Confirm Selection</button>
        </div>
      </form>
      </div>
    </div>
  </div>
</html>
</body>
<?php
require "footer.php"
?>
