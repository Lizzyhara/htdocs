<!DOCTYPE html>
<html>
  <head>
    <title> Reset Passwort </title>
    <link rel="stylesheet" type="text/css" href="../static/login.css?v=<?=time();?>">
  </head>
  <body>

   <form action="../reset-password.php" method="post">
        <h2>Reset Passwort</h2>
        <?php if (isset($_GET['error'])){?>
         <p class="error"><?php echo $_GET['error']; ?> </p>
        <?php } ?>
      <label>E-Mail</label>
        <input type="text" name="mail" placeholder="Geben Sie Ihre E-Mail Ein"/><br>
      
     <button type="submit" name="password_reset_link">Reset</button>
     <a href = "index.php" class="ca">Login</a>
    </form>
    
  </body>
</html>