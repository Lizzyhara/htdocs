<!DOCTYPE html>
<html>
<!--template for sending mail to validate-->
<head>
    <title>Validate Mail</title>
    <link rel="stylesheet" type="text/css" href="../static/login.css?v=<?= time(); ?>">
</head>

<body>

    <form action="../validate_mail.php" method="post"><!--uses validate_mail.php-->
        <h2>Gebe deine Mail ein und bestätige deine Mail</h2>
        <!--checks for errors-->
        <?php if (isset($_GET['error'])) { ?>
            <p class="error">
                <?php echo $_GET['error']; ?>
            </p>
        <?php } ?>
        <!--enter mail-->
        <p> E-Mail</p>
        <input type="text" name="mail" value="<?php if (isset($_GET['email'])) {
            echo $_GET['email'];
        } ?>" /><br>
        <button type="submit" name="send_mail">Senden</button>
        <a href="index.php" class="ca">Login</a>
    </form>
</body>

</html>