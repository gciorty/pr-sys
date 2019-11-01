<?php
require "header.php"
?>

    <main>
        <h1>Home</h1>
        <div class="home-div">
          <?php
              if (isset($_SESSION['userID'])) {
                if(!isset($_COOKIE['UserID'])) {
                  setcookie('UserID', $_SESSION['userID']);
                  $_COOKIE['UserId'] = $_SESSION['userID'];
                }
                  echo '<p>You are logged in</p>';
                  if(isset($_COOKIE['UserID'])){
                    echo '<p>As userID: ' . $_COOKIE['UserID'] . '</p>';
                  } else {
                      echo '<p>As userID: ' . $_SESSION['userID'] . '</p>';
                  }
              } else {
                if (!isset($_POST['login-submit'])){
                  header("Location: index.php");
                  exit();
                }
              }
          ?>
        </div>
    </main>

<?php
require "footer.php"
?>
