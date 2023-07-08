<!DOCTYPE html>
<html>
<!--register new user-->
<head>
  <title> Sign up </title>
  <link rel="stylesheet" type="text/css" href="../static/login.css?v=<?= time(); ?>">
</head>

<body>
  <form action="../signup_check.php" method="post">
    <h2>REGISTRIERUNG</h2>
    <!--checks for errors-->
    <?php if (isset($_GET['error'])) { ?>
      <p class="error">
        <?php echo $_GET['error']; ?>
      </p>
    <?php } ?>
    <!--checks for success-->
    <?php if (isset($_GET['success'])) { ?>
      <p class="success">
        <?php echo $_GET['success']; ?>
      </p>
    <?php } ?>
      <!--input boxes for user information-->
    <label>Name</label>
    <?php if (isset($_GET['name'])) { ?>
      <input type="text" name="name" placeholder="Name" value="<?php echo $_GET['name']; ?>"><br>
    <?php } else { ?>
      <input type="text" name="name" placeholder="Name"><br>
    <?php } ?>

    <label>Benutzername</label>
    <?php if (isset($_GET['uname'])) { ?>
      <input type="text" name="uname" placeholder="Benutzername" value="<?php echo $_GET['uname']; ?>"><br>
    <?php } else { ?>
      <input type="text" name="uname" placeholder="Benutzername"><br>
    <?php } ?>
    <label>Email</label>
    <input type="mail" name="mail" placeholder="Email" /><br>
    <label>Passwort</label>
    <input type="password" name="password" placeholder="Passwort" /><br>
    <label>Bestätige das Passwort</label>
    <input type="password" name="re_password" placeholder="RE_Passwort" /><br>

    <button type="submit">Registrieren</button>
    <a href="index.php" class="ca"> Besitzt bereits einen Account </a>
  </form>

</body>

</html>