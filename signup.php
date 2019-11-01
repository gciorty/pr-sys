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
                      echo '<p>Please fill in all fields</p>';
                  } else if ($_GET['error'] == "invalidemail") {
                      echo '<p>Use valid email address</p>';
                  }
              } else if (isset($_GET['signup'])) {
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
              <button type="submit" name="signup-submit">Create</button>
              <p class="message">Already have an account? <a href="index.php"><strong>Click here</strong></a></p>
            </form>
          </div>
        </div>
    </div>
    </body>

</html>
