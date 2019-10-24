<!DOCTYPE html>

<html>

    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Review Peer System - Login Page</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="css/form-style.css">
    </head>

    <body>
      <div class="container">
        <div class="page-header">
          <h1>Peer Review System</h1>
        </div>
        <div class="login-page">
          <div class="form">
            <form class="login-form" action="includes/login.inc.php" method="post">
              <input type="text" name="userID" placeholder="User ID"/>
              <input type="password" name="pwd" placeholder="Password"/>
              <button type="submit" name="login-submit">login</button>
              <p class="message">Not Registred? <a href="signup.php"><strong>Create an account</strong></a></p>
            </form>
          </div>
        </div>
        <?php
            if (isset($_GET['signup'])) {
                if ($_GET['signup'] == "success") {
                    echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span><strong>Success!</strong> You are now registered. Please Login.</div>';
                }
            } else if (isset($_GET['error'])) {
                if ($_GET['error'] == "emptyfields") {
                    echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span><strong>Error!</strong> You missed an input field.</div>';
                }
            }
        ?>
      </div>
    </body>

</html>
