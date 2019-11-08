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
        <form id="reviewform" class="review-form" action="" method="post">
          <div class="col-auto">
            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" onchange=resetForm();>
              <option selected>Choose group member to evaluate</option>
              <?php
                foreach ($groupMembers as $member) {
                  echo '<option value="'.$member.'">'.$member.'</option>';
                }
              ?>
            </select>
          </div>
          <hr>
          <div class="col-auto">
            <p><strong>Rate the member</strong></p>
            <?php
              for ($i = 1; $i <= 10; $i++) {
                echo '<div class="custom-control custom-radio custom-control-inline" value="' . $i . '">
                        <input type="radio" class="custom-control-input" id="r' . $i . '" name="rating">
                        <label class="custom-control-label" for="r' . $i . '">'.$i.'</label>
                      </div>';
              }
            ?>
          </div>
          <hr>
          <div class="col-auto">
            <p><strong>Rate Justification</strong></p>
            <textarea class="form-control" id="rate-form" rows="3"></textarea>
          </div>
          <hr>
          <div class="col-auto" id="rate-upload">
            <p><strong>Upload Image</strong><small> (optional) </small></p>
            <button class="btn btn-secondary" type="submit">Upload File</button>
          </div>
          <hr>
          <div class="col-auto">
            <button class="btn btn-outline-primary" type="submit">Provision Evaluation</button>
            <button class="btn btn-primary" type="submit">Finalize Evaluation</button>
          </div>
        </form>
      </div>
    </div>

    <script type="text/javascript">
      function resetForm() {
        document.getElementById("rate-form").value = "";
        var radioButton = document.getElementsByName("rating");
        for(var i=0; i<radioButton.length; i++)
           radioButton[i].checked = false;
      }
    </script>

  </body>
</html>

<?php
require "footer.php"
?>
