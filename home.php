<?php
require "header.php"
?>

    <main>
        <h1>Peer Review System</h1>
        <div class="home-div">
          <?php
              if (isset($_SESSION['userID'])) {
                  echo '<p>You are logged in</p>';
              } else {
                  echo '<p>You are logged out</p>';
              }
          ?>
        </div>
    </main>

<?php
require "footer.php"
?>
