<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DOC To PDF Cloud API Example</title>
    <link rel="stylesheet" type="text/css" href="../static/basic.css">
    <link rel="stylesheet" type="text/css" href="../static/pdf.css?v=<?=time();?>">
</head>
<body>
    <section class="background">
    <div class="header" id="header">
        <nav>
            <div class="nav-links">
                <ul>
                    <li><a href='home.php'>HOME</a></li>
                    <li><a href='ToDo.php'>TODO</a></li>
                    <li><a href='change-password.php'>PASSWORT ÄNDERN</a></li>
                    <li><a href='../login.php'>LOGOUT</a></li>
                </ul>
            </div>
        </nav>
    </div>
    <form name="form1" enctype="multipart/form-data" method="post" action="../doc-to-pdf.php">
        <div class="center">
            <div class="outer_box">
                <h1>PDF Konverter</h1>
                <?php if (isset($_GET['error'])){?>
                <p class="error"><?php echo $_GET['error']; ?> </p>
                <?php } ?>
                <p>
                    <label>Bitte den API Key eintragen. Dieser ist bei einer Anmeldung bie PDF CO zu bekommen.<a href="https://apidocs.pdf.co">https://apidocs.pdf.co</a>.</label>
                    <br/>
                    <input type="text" id="api_key_input" name="apiKey" placeholder="API Key"/>
                </p>
                        <div class= "input_box">
                            <p>
                                <label>Input DOC or DOCX File (*.doc; *.docx)
                                <input type="hidden" name="MAX_FILE_SIZE" value="8000000"/>
                    <input class="input_file" type="file" name="file"/>
                            </label>
                            </p>
                        </div>
                <input class="proceed" type="submit" name="submit" value="Proceed" />
            <div>
        <div>
    </form>
    </section>
    <script type="text/javascript" src="../static/dragndrop.js"></script>
    <script type="text/javascript" src="../static/header.js"></script>
</body>
</html>