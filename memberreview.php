<?php
require "header.php";
?>
<html>
  <body>
    <div class="container my-3 py-3 z-depth-1">
      <div class="jumbotron">
        <h1 class="display-4">Member Evaluation Form</h1>
        <p class="lead">Please evaluate your member.</p>
        <hr>
        <form name="review-form" class="review-form" action="includes/performeval.inc.php" method="post" enctype="multipart/form-data">
          <div class="col-auto">
          <p><strong>Selected Member</strong></p>
          <input type="text" name="selectedUser" value="<?php echo $_SESSION['memberToMark']?>" id="selectedUser" style="border:0; font-size:24px; background: transparent" readonly="true"><br>
          </div>
          <hr>
          <div class="col-auto">
            <p><strong>Rate the member</strong></p>
            <?php
              if (empty($_SESSION['memberReview'][0])) {
                for ($i = 1; $i <= 10; $i++) {
                  echo '<input type="radio" name="rating" value="'.$i.'">'.$i.'';
                }
              } else {
                for ($i = 1; $i <= 10; $i++) {
                  if ($_SESSION['memberReview'][0] == $i){
                    echo '<input type="radio" name="rating" value="'.$i.'" checked>'.$i.'';
                  } else {
                    echo '<input type="radio" name="rating" value="'.$i.'">'.$i.'';
                  }
                }
              }
            ?>
          </div>
          <hr>
          <div class="col-auto">
            <p><strong>Rate Justification</strong></p>
            <textarea class="form-control" name="ratejus" id="rate-form" rows="3"><?php
              if (empty($_SESSION['memberReview'][1])) {
                  echo '';
              } else {
                echo $_SESSION['memberReview'][1];
              }
            ?></textarea>
          </div>
          <hr>
          <div class="col-auto" id="rate-upload">
                <p><strong>Select image to upload </strong><small>(max 16 kb - 75 px)</small>:</p>
                <input type="file" name="fileToUpload" id="fileToUpload">
                <div>
                  <br>
                  <?php
                  if (!empty($_SESSION['memberReview'][2])) {
                    echo '
                      <p>Current Image:</p>
                      <img src="data:'.$_SESSION['memberReview'][3].';base64,'.$_SESSION['memberReview'][2].'" alt="upload image" width="80px" />
                      <div class="custom-control custom-checkbox">
                          <br>
                          <input type="checkbox" class="custom-control-input" id="deleteImage" name="deleteImage" value="1">
                          <label class="custom-control-label" for="deleteImage">Delete the uploaded image <small>(submit to confirm)</small></label>
                      </div>';
                  }
                  ?>
                </div>
          </div>
          <hr>
          <div class="col-auto">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="finalizeMark" name="finalizeMark" value="1">
                <label class="custom-control-label" for="finalizeMark">Check the box to finalize the evaluation <small>(cannot be changed)</small></label>
            </div>
            <br>
            <button class="btn btn-primary" name="review-form" type="submit">Submit Evaluation</button>

          </div>
        </form>
        <hr>
        <div class="col-auto">
          <form name="del-eval" class="del-eval" action="includes/deleval.inc.php" method="post">
            <p>Becareful! This deletes the provisioned evaluation submitted</p>
            <button class="btn btn-danger" name="delete-review" type="submit">Delete Evaluation</button>
          </form>
        </div>
      </div>
    </div>

    <script type="text/javascript">
      function resetForm() {
        document.getElementById("rate-form").value = "";
        var radioButton = document.getElementsByName("rating");
        for(var i=0; i<radioButton.length; i++)
           radioButton[i].checked = false;
        console.log('reset form actioned');
      }
    </script>

  </body>
</html>

<?php
require "footer.php"
?>
