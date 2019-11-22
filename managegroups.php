<?php
require "header.php";
require "includes/get-activegroups.php"
?>


<html>
<body>
<div class="container my-3 py-3 z-depth-1">
  <div class="jumbotron">
    <div class="col-auto">
      <p class="display-4">Group Management</p>
    </div>
    <p class="lead">In this area you can select the group and see the reviews status<small> (empty groups will not show up - please select available group form drop down menu)</small></p>
    <hr>
    <div class="col-auto">
    <form name="groupsListForm" action="includes/get-groupmemstatus.inc.php" method="post">
      <div>
        <select class="custom-select mr-sm-1" name="groupToManage" id="inlineFormCustomSelect"  >
          <?php
            if(empty($groups)) {
              echo '<option disabled>No Group Members Enrolled Yet</option>';
            } else {
              foreach ($groups as $g) {
                echo '<option value="'.$g.'">Group '.$g.'</option>';
              }
            }
          ?>
        </select>
      </div>
      <br>
      <div>
        <button class="btn btn-primary" name="selectgroup-submit" type="submit" <?php if(empty($groups)){ echo 'disabled'; } ?>>Confirm Selection</button>
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
