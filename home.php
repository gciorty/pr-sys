<?php
require "header.php"
?>
<html>
  <div class="container my-5 py-5 z-depth-1">

    <!--Section: Content-->
    <section class="px-md-5 mx-md-5 text-center text-lg-left dark-grey-text">

      <!--Grid row-->
      <div class="row d-flex justify-content-center">

        <!--Grid column-->
        <div class="col-lg-8 text-center">
          <!--Image-->
          <div class="view overlay z-depth-1-half">
            <img src="/pr-sys/img/UoG_BLACK.png" class="img-fluid" alt="">
          </div>

          <h3 class="font-weight-bold mb-4">Welcome to the Peer Review System</h3>
          <p class="text-muted"><?php
            if (isset($_SESSION['userID'])) {
              if(!isset($_COOKIE['UserID'])) {
                setcookie('UserID', $_SESSION['userID']);
                $_COOKIE['UserId'] = $_SESSION['userID'];
              }
                echo '<p>You are logged in to the System</p>';
                if(isset($_COOKIE['UserID'])){
                  echo '<p>Your userID: ' . $_COOKIE['UserID'] . ' - Member of Group ' . $_SESSION['group'] . '</p>';
                } else {
                    echo '<p>Your userID: ' . $_SESSION['userID'] . ' - Member of Group ' . $_SESSION['group'] . '</p>';
                }
            } else {
              if (!isset($_POST['login-submit'])){
                header("Location: index.php");
                exit();
              }
            }
          ?></p>

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->


    </section>
    <!--Section: Content-->


  </div>
</html>
<?php
require "footer.php"
?>
