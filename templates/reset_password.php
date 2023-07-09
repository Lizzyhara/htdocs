<!DOCTYPE html>
<html>
<!--sends a mail with link to change the password-->

<head>
  <title> Reset password </title>
  <link rel="stylesheet" type="text/css" href="../static/login.css?v=<?= time(); ?>">
</head>

<body>

  <form action="../send_reset_password.php" method="post"><!--uses send_reset_password.php-->
    <h2>Passwort zurücksetzen</h2>
    <!--shows errors-->
    <?php if (isset($_GET['error'])) { ?>
      <p class="error">
        <?php echo $_GET['error']; ?>
      </p>
    <?php } ?>
    <!--input mail-->
    <label>E-Mail</label>
    <input type="text" name="mail" placeholder="Geben Sie Ihre E-Mail Ein" /><br>

    <button type="submit" name="password_reset_link">Zurücksetzen</button>
    <a href="index.php" class="ca">Login</a>
  </form>

</body>

</html>