<!DOCTYPE html>
<html>
<!--change mail with password -->

<head>
  <title> Reset password with mail </title>
  <link rel="stylesheet" type="text/css" href="../static/login.css?v=<?= time(); ?>">
</head>

<body>
  <form action="../chang_w_mail.php" method="post"><!--uses chang_w_mail.php-->
    <h2>Passwort ändern</h2>
    <input type="hidden" name="token" value="<?php if (isset($_GET['token'])) { //displays -> hides token
        echo $_GET['token'];
      } ?>" /><br>
    <!--checks for errors-->
    <?php if (isset($_GET['error'])) { ?>
      <p class="error">
        <?php echo $_GET['error']; ?>
      </p>
    <?php } ?>
    <input type="hidden" name="email" value="<?php if (isset($_GET['email'])) {
      echo $_GET['email'];
    } ?>" /><br>
    <!--input for passswords-->
    <label>Neues Passwort</label>
    <input type="text" name="new_pass" placeholder="Geben Sie Ihre E-Mail Ein" /><br>
    <label>Bestätigung Neues Passwort</label>
    <input type="text" name="con_pass" placeholder="Geben Sie Ihre E-Mail Ein" /><br>
    <button type="submit" name="password_reset_link">Passwort ändern</button>
    <a href="index.php" class="ca">Login</a>
  </form>

</body>

</html>