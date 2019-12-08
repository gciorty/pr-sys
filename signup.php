<!DOCTYPE html>
<?php
require "includes/get-availgroups.inc.php";
?>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="description" content="web searches">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Review Peer System - Signup Page </title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
      <div class="container col-md-6 offset-md-3 my-1 py-1 z-depth-1">
          <?php
              if (isset($_GET['error'])) {
                  if ($_GET['error'] == "emptyfields") {
                      echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span><strong>Error!</strong> Please fill all fields. </div>';
                  } else if ($_GET['error'] == "invalidemailformat") {
                      echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span><strong>Error!</strong> Please use valid email address. </div>';
                  } else if ($_GET['error'] == "captchaerr") {
                      echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span><strong>Error!</strong> Wrong captcha code typed. Try Again. </div>';
                  } else if ($_GET['error'] == "groupFull") {
                      echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span><strong>Error!</strong> The selected group already has 3 members. Try Again. </div>';
                  } else if ($_GET['error'] == "invalidUserID") {
                      echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span><strong>Error!</strong> ID must be between 9 to 10 digit. Try Again. </div>';
                  }  else if ($_GET['error'] == "pwdNotMatch") {
                      echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span><strong>Error!</strong> Password do not match. Try Again. </div>';
                  } else if ($_GET['error'] == "usertaken") {
                      echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span><strong>Error!</strong> ID is already registered. Try Again. </div>';
                  } else if ($_GET['error'] == "passwordStrenght") {
                      echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span><strong>Error!</strong> Password not strong enough - Use at least 7 characters, 1 Uppen case and 1 number. Try Again. </div>';
                  }
                }
              if (isset($_GET['signup'])) {
                  if ($_GET['signup'] == "success") {
                      header("Location: index.php?signup=success");
                  }
              }
            //
          ?>

          <div class="jumbotron">
            <div class="view overlay z-depth-1-half">
              <h1 class="text-center">Peer Review System</h1>
              <br>
            </div col-md-6 offset-md-3>
            <div class="col-md-8 offset-md-2">
            <div class="card card-outline-secondary">
                <div class="card-header">
                    <h3 class="mb-0">Signup</h3>
                </div>
                <div class="card-body">
                  <form class="form" role="form" autocomplete="off" action="includes/signup.inc.php" method="post">
                    <div class="form-group">
                        <label for="uid">User ID</label>
                        <input type="number" class="form-control" name="uid" required="" value="<?php echo isset($_REQUEST['uid']) ? $_REQUEST['uid'] : '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" name="email" required="" value="<?php echo isset($_REQUEST['email']) ? $_REQUEST['email'] : '' ?>">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="pwd" required="" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Repeat Password</label>
                        <input type="password" class="form-control" name="pwd-repeat" required="" autocomplete="off">
                    </div>
                    <div class="form-group">
                      <label>Select Group</label>
                      <select name="group" required="" style="width:100%;background:#f2f2f2;font-size: 14px;color: #606060; padding: 15px; margin: 0 0 15px;border: 0;" >
                        <?php
                          foreach ($availGroups as $g) {
                            if (isset($_REQUEST['group'])) {
                              if ($_REQUEST['group'] == $g) {
                                echo '<option value="'.$g.'" selected>Group '.$g.'</option>';
                              }
                            }
                            echo '<option value="'.$g.'" >Group '.$g.'</option>';
                          }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Enter Captcha Code</label>
                      <input type="text" class="form-control" name="captcha" required="">
                      <br>
                      <div class="capwrapper">
                        <img src="includes/captcha.inc.php" width="150" height="30" border="1" alt="CAPTCHA" class="center" id="capt">
                        <p class="message">Click <a href="#" onClick=reloadCaptcha();><strong>here</strong></a> to reload</p>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-lg float-right" type="submit" name="signup-submit">Create Account</button>
                    <a class="btn btn-secondary btn-lg float-left" href="index.php" role="button">Login</a>
                  </form>
                </div>
                <!--/card-body-->
            </div>
            <div class="view overlay z-depth-1-half">
              <br>
              <img src="img/UoG_BLACK.png" class="rounded mx-auto d-block" width="50%" alt="uog-logo">
            </div>
          </div>
          </div>
        </div>
    </div>


    <script type="text/javascript">
      function reloadCaptcha() {
        img = document.getElementById("capt");
        img.src="includes/captcha.inc.php";
      }
    </script>

    </body>

</html>
