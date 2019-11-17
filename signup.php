<!DOCTYPE html>

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
      <div class="container">
        <div class="page-header">
          <h1>Peer Review System</h1>
          <?php
              if (isset($_GET['error'])) {
                  if ($_GET['error'] == "emptyfields") {
                      echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span><strong>Error!</strong> Please fill all fields.</div>';
                  } else if ($_GET['error'] == "invalidemail") {
                      echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span><strong>Error!</strong> Please use valid email address</div>';
                  } else if ($_GET['error'] == "captchaerr") {
                      echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span><strong>Error!</strong> Wrong captcha code typed. Try Again.</div>';
                  } else if ($_GET['error'] == "groupFull") {
                      echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span><strong>Error!</strong> The selected group already has 3 members enrolled Try Again.</div>';
                  }
                }
              if (isset($_GET['signup'])) {
                  if ($_GET['signup'] == "success") {
                      header("Location: index.php?signup=success");
                  }
              }
          ?>
        </div>

        <div class="login-page">
          <div class="form">
            <form class="reg-form" action="includes/signup.inc.php" method="post">
              <input type="text" name="uid" placeholder="User ID"/>
              <input type="text" name="email" placeholder="Email"/>
              <input type="password" name="pwd" placeholder="Password"/>
              <input type="password" name="pwd-repeat" placeholder="Repeat Password"/>
              <select name="group" style="width:100%;background:#f2f2f2;font-size: 14px;color: #606060; padding: 15px; margin: 0 0 15px;border: 0;" >
                <option value="" disabled selected>Select your group</option>
                <option value="1">Group 1</option>
                <option value="2">Group 2</option>
                <option value="3">Group 3</option>
                <option value="4">Group 4</option>
                <option value="5">Group 5</option>
                <option value="6">Group 6</option>
                <option value="7">Group 7</option>
                <option value="8">Group 8</option>
                <option value="9">Group 9</option>
                <option value="10">Group 10</option>
              </select>
              <p><input type="text" name="captcha" placeholder="Enter CAPTCHA code below"></p>
              <p><img src="includes/captcha.inc.php" width="150" height="30" border="1" alt="CAPTCHA" id="capt"></p>
              <p class="message">Click <a href="#" onClick=reloadCaptcha();><strong>here</strong></a> to reload</p>
              <p></p>
              <button type="submit" name="signup-submit">Create Account</button>
              <p class="message">Already have an account? <a href="index.php"><strong>Click here</strong></a></p>
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
