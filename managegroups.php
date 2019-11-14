<?php
require "header.php";
require "includes/get-activegroups.php"
?>

<body>
<html>
<div class="container my-3 py-3 z-depth-1">
  <div class="jumbotron">
    <div class="col-auto">
      <p class="display-4">Group Management</p>
    </div>
    <p class="lead">In this area you can select the group and see the reviews status<small> (empty groups will not show up)</small></p>
    <hr>
    <div class="col-auto">
    <form name="groupsListForm" action="includes/get-groupmemstatus.inc.php" method="post">
      <div>
        <select class="custom-select mr-sm-1" name="groupToManage" id="inlineFormCustomSelect"  >
          <option selected>Select group to manage</option>
          <?php
            foreach ($groups as $g) {
              echo '<option value="'.$g.'">Group '.$g.'</option>';
            }
          ?>
        </select>
      </div>
      <br>
      <div>
        <button class="btn btn-primary" name="selectgroup-submit" type="submit">Confirm Selection</button>
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