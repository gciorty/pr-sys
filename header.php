<?php
session_start();
if (!isset($_SESSION['userID'])) {
  if (!isset($_POST['login-submit'])){
    header("Location: index.php?error=notloggedin");
    exit();
  }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="web searches">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Peer Review System </title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </head>

    <body>
        <header>

          <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <!-- Brand -->
            <a class="navbar-brand" href="home.php">PR-SYS</a>

            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
              <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
              <ul class="navbar-nav">
                <li class="nav-item" >
                <?php
                  if (basename($_SERVER['PHP_SELF']) == 'members.php'){
                    echo '<a class="nav-link" style="color:white" href="members.php" active>Group Members</a>';
                  } else {
                      echo '<a class="nav-link"  href="members.php">Group Members</a>';
                  }
                ?>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
                </li>
              </ul>
              <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                  <a class="nav-link" href="includes/logout.inc.php">Logout</a>
                </li>
              </ul>
            </div>

          </nav>

        </header>
    </body>
</html>
