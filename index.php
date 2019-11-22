<!DOCTYPE html>

<html>

    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Review Peer System - Login Page</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
      <div class="container col-md-6 offset-md-3 my-1 py-1 z-depth-1">
        <?php
            if (isset($_GET['signup'])) {
                if ($_GET['signup'] == "success") {
                    echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span><strong>Success!</strong> You are now registered. Please Login.</div>';
                }
            } else if (isset($_GET['error'])) {
                if ($_GET['error'] == "emptyfields") {
                    echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span><strong>Error!</strong> You missed an input field.</div>';
                }
                if ($_GET['error'] == "wrongpwd") {
                    echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span><strong>Error!</strong> Wrong pasword typed. Try Again.</div>';
                }
                if ($_GET['error'] == "nouser") {
                    echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span><strong>Error!</strong> User not registered. Try Again.</div>';
                }
            } else if (isset($_GET['logout'])) {
                if ($_GET['logout'] == "success") {
                    setcookie('UserID', '', time()-3600);
                }
            }
        ?>
        <div class="jumbotron">
          <div class="view overlay z-depth-1-half">
            <h1 class="text-center">Peer Review System</h1>
            <br>
          </div col-md-6 offset-md-3>
          <div class="col-md-8 offset-md-2">
          <div class="card card-outline-secondary">
              <div class="card-header">
                  <h3 class="mb-0">Login</h3>
              </div>
              <div class="card-body">
                  <form class="form" role="form" autocomplete="off" action="includes/login.inc.php" method="post">
                      <div class="form-group">
                          <label for="userID">User ID</label>
                          <input type="number" class="form-control" name="userID" required="">
                      </div>
                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" class="form-control" name="pwd" required="" autocomplete="off">
                      </div>
                      <a class="btn btn-secondary btn-lg float-left" href="signup.php" role="button">Signup</a>
                      <button type="submit" class="btn btn-success btn-lg float-right" type="submit" name="login-submit">Login</button>
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
    </body>

</html>
