<!DOCTYPE html>
<html>
  <header>
  </header>

  <body>
    <p>This is a Test Form</p>

    <form method="POST" action="captcha-res.php">
      <p><img src="includes/captcha.inc.php" width="120" height="30" border="1" alt="CAPTCHA"></p>
      <p><input type="text" size="10" maxlength="5" name="captcha" value=""><br>
      <small>copy the digits from the image into this box</small></p>
      <p><input type="submit"></p>
    </form>

  </body>
</html>
