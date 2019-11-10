<?php
require "header.php";
require "includes/getmembers.inc.php"
?>
<html>
  <body>
    <div class="container my-3 py-3 z-depth-1">
      <div class="jumbotron">
        <h1 class="display-4">Member Evaluation Form</h1>
        <p class="lead">Please select a member from the drop-down menu and add your review.</p>
        <hr>
        <div class="col-auto">
        <form name="memberListForm" action="includes/getmemeval.inc.php" method="post">
          <div>
            <select class="custom-select mr-sm-1" name="memberToMark" id="inlineFormCustomSelect"  >
              <option selected>Choose group member to evaluate</option>
              <?php
                foreach ($groupMembers as $member) {
                  echo '<option value="'.$member.'">'.$member.'</option>';
                }
              ?>
            </select>
          </div>
          <br>
          <div>
            <button class="btn btn-primary" name="selectmem-submit" type="submit">Confirm Selection</button>
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
