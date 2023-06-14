
<!DOCTYPE html>
<html>
  <head>
    <title> Reset Passwort </title>
    <link rel="stylesheet" type="text/css" href="../static/login.css?v=<?=time();?>">
  </head>
  <body>

   <form action="../chang_w_mail.php" method="post">
        <h2>Passwort ändern</h2>
        <input typ="hidden" name="token" value="<?php if(isset($_GET['token'])){echo $_GET['token'];}?>">
        <?php if (isset($_GET['error'])){?>
         <p class="error"><?php echo $_GET['error']; ?> </p>
        <?php } ?>
      <label>E-Mail</label>
        <input type="text" name="email" placeholder="Geben Sie Ihre E-Mail Ein"/><br>
      <label>Neues Passwort</label>
        <input type="text" name="new_pass" placeholder="Geben Sie Ihre E-Mail Ein"/><br>
      <label>Bestätigung Neues Passwort</label>
        <input type="text" name="con_pass" placeholder="Geben Sie Ihre E-Mail Ein"/><br>
     <button type="submit" name="password_reset_link">Passwort ändern</button>
     <a href = "index.php" class="ca">Login</a>
    </form>
    
  </body>
</html>