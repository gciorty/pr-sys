<?php
require "header.php";
?>


<html>
<body>
  <div class="container my-3 py-3 z-depth-1">
    <div>
      <?php
          if (isset($_GET['success'])) {
              if ($_GET['success'] == "reviewdeleted") {
                  echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span><strong>Success!</strong> You have delete the review for the member.</div>';
              }
              if ($_GET['success'] == "reminderSent") {
                  echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span><strong>Success!</strong> The reminder to submit and finalize the reviews has been sent to all the memebers of the group.</div>';
              }
              if ($_GET['success'] == "overallSent") {
                  echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span><strong>Success!</strong> The email with the overall rating of the group has been sent to all the members.</div>';
              }
              if ($_GET['success'] == "reviewSaved") {
                  echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span><strong>Success!</strong> You review was saved to the system.</div>';
              }
          } else if (isset($_GET['error'])) {
              if ($_GET['error'] == "finalized") {
                  echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span><strong>Error!</strong> You finalized the review for the specific member.</div>';
              }
          }
      ?>
    </div>
    <div class="jumbotron">
    <!--Section: Content-->
    <section class="px-md-5 mx-md-5 text-center text-lg-left dark-grey-text">

      <!--Grid row-->
      <div class="row d-flex justify-content-center">

        <!--Grid column-->
        <div class="col-lg-8 text-center">
          <!--Image-->
          <div class="view overlay z-depth-1-half">
            <img src="/~gc8298r/img/UoG_BLACK.png" class="img-fluid" alt="">
          </div>

          <h3 class="font-weight-bold mb-4">Welcome to the Peer Review System</h3>

          <p class="text-muted">
            <?php
            if (isset($_SESSION['userID'])) {
              if(!isset($_COOKIE['UserID'])) {
                setcookie('UserID', $_SESSION['userID']);
                $_COOKIE['UserId'] = $_SESSION['userID'];
              }
                echo '<p>You are logged in to the System</p>';
                if($_SESSION['userID'] == "000000000"){
                  echo '<p>Welcome <strong>Tutor</strong> - Please Review the Evaluations</p>';
                } else {
                  if(isset($_COOKIE['UserID'])){
                    echo '<p>Your userID: ' . $_COOKIE['UserID'] . ' - Member of Group ' . $_SESSION['groupID'] . '</p>';
                  } else {
                      echo '<p>Your userID: ' . $_SESSION['userID'] . ' - Member of Group ' . $_SESSION['groupID'] . '</p>';
                  }
                }
            }
          ?>
        </p>

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->


    </section>
    <!--Section: Content-->

    </div>
  </div>
</body>
</html>

<?php
require "footer.php"
?>
