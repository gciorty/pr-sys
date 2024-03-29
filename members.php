<?php
require "header.php";
require "includes/get-members.inc.php"
?>
<html>
  <body>
    <div class="container my-3 py-3 z-depth-1">
      <div class="jumbotron">
        <div class="col-auto">
          <p class="display-4">Member Evaluation Form</p>
        </div>
        <p class="lead">Please select a member from the drop-down menu and add your review.</p>
        <hr>
        <div class="col-auto">
        <form name="memberListForm" action="memberreview.php" method="get">
          <div>
            <select class="custom-select mr-sm-1" name="memberToMark" id="inlineFormCustomSelect"  >
              <?php
                if(empty($groupMembers)) {
                  echo '<option disabled>No Group Members Enrolled Yet</option>';
                } else {
                  foreach ($groupMembers as $member) {
                    echo '<option value="'.$member.'">'.$member.'</option>';
                  }
                }
              ?>
            </select>
          </div>
          <br>
          <div>
            <button class="btn btn-primary" name="selectmem-submit" type="submit" <?php if(empty($groupMembers)){ echo 'disabled'; } ?>>Confirm Selection</button>
          </div>
        </form>
        </div>
      </div>
    </div>
  </body>
</html>

<?php
require "footer.php"
?>
