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
      <div class="container">

        <div class="page-header">
          <h1>Peer Review System</h1>
        </div>
        <div>
          <?php
              if (isset($_GET['signup'])) {
                  if ($_GET['signup'] == "success") {
                      echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span><strong>Success!</strong> You are now registered. Please Login.</div>';
                  }
              } else if (isset($_GET['error'])) {
                  if ($_GET['error'] == "emptyfields") {
                      echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span><strong>Error!</strong> You missed an input field.</div>';
                  }
                  if ($_GET['error'] == "captchaerr") {
                      echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span><strong>Error!</strong> Wrong captcha code typed. Try Again.</div>';
                  }
              } else if (isset($_GET['logout'])) {
                  if ($_GET['logout'] == "success") {
                      setcookie('UserID', '', time()-3600);
                  }
              }

              //setcookie('UserID', '', time()-3600);
          ?>
        </div>
        <div class="login-page">
          <div class="form">
            <form class="login-form" action="includes/login.inc.php" method="post">
              <input type="text" name="userID" placeholder="User ID"/>
              <input type="password" name="pwd" placeholder="Password"/>
              <p><input type="text" name="captcha" placeholder="Enter CAPTCHA code below"></p>
              <p><img src="includes/captcha.inc.php" width="120" height="30" border="1" alt="CAPTCHA" id="capt"></p>
              <p class="message">Click <a href="#" onClick=reloadCaptcha();><strong>here</strong></a> to reload</p>
              <p></p>
              <button type="submit" name="login-submit">login</button>
              <p class="message">Not Registred? <a href="signup.php"><strong>Create an account</strong></a></p>
            </form>
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
