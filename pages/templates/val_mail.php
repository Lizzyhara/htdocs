<!DOCTYPE html>
<html>
<!--template for validating mail-->

<head>
    <title> Validates mail last step</title>
    <link rel="stylesheet" type="text/css" href="../static/css/login.css?v=<?= time(); ?>">
</head>

<body>
    <form action="../php/end_val_mail.php" method="post"><!--uses end_val_mail-->
        <input type="hidden" name="token" value="<?php if (isset($_GET['token'])) { //displays, hides token for php useage
                echo $_GET['token'];
            } ?>" /><br>
        <!--shows errors-->
        <?php if (isset($_GET['error'])) { ?>
            <p class="error">
                <?php echo $_GET['error']; ?>
            </p>
        <?php } ?>
        <!--displays, hides token for php useage-->
        <input type="hidden" name="email" value="<?php if (isset($_GET['email'])) {
            echo $_GET['email'];
        } ?>" /><br>
        <h4>Bitte validiren Sie ihre Mail, indem Sie auf den Knopf drücken.</h4>
        <button type="submit" name="validate_btn">Validieren</button>
    </form>

</body>

</html>