<!DOCTYPE html>
<html>
<!--login page-->

<head>
  <title> Login </title>
  <link rel="stylesheet" type="text/css" href="../static/css/login.css?v=<?= time(); ?>">
</head>

<body>

  <form action="../php/login.php" method="post"><!--uses login.php-->
    <h2>LOGIN</h2>
    <!--shows errors-->
    <?php if (isset($_GET['error'])) { ?>
      <p class="error">
        <?php echo $_GET['error']; ?>
      </p>
    <?php } ?>
    <!--shows success-->
    <?php if (isset($_GET['success'])) { ?>
      <p class="success">
        <?php echo $_GET['success']; ?>
      </p>
    <?php } ?>
    <!--input for information-->
    <label>Benutzername</label>
    <input type="text" name="uname" placeholder="Geben Sie Ihren Benutzernamen Ein" /><br>

    <label>Passwort</label>
    <input type="password" name="password" placeholder="Geben Sie Ihr Passwort Ein" /><br>

    <button type="submit">Login</button>
    <a href="signup.php" class="ca">Registrieren</a>
    <a href="reset_password.php" class="ca"> Passwort vergessen? </a>
  </form>

</body>

</html>