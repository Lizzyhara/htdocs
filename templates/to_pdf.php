<!DOCTYPE html>
<html lang="en">
<!--upload docs files and get the pdf version-->
<head>
    <meta charset="UTF-8">
    <title>dragndrop to PDF</title>
    <link rel="stylesheet" type="text/css" href="../static/basic.css">
    <link rel="stylesheet" type="text/css" href="../static/pdf.css?v=<?= time(); ?>">
</head>

<body>
    <section class="background">
        <div class="header" id="header">
            <nav>
                <div class="nav-links">
                    <ul>
                        <li><a href='home.php'>HOME</a></li>
                        <li><a href='todo.php'>TODO</a></li>
                        <li><a href='change_password.php'>PASSWORT ÄNDERN</a></li>
                        <li><a href='../login.php'>LOGOUT</a></li>
                    </ul>
                </div>
            </nav>
        </div>
        <form name="form1" enctype="multipart/form-data" method="post" action="../doc_to_pdf.php">
            <div class="center">
                <div class="outer_box">
                    <h1>PDF Konverter</h1>
                    <?php if (isset($_GET['error'])) { ?>
                        <p class="error">
                            <?php echo $_GET['error']; ?>
                        </p>
                    <?php } ?>
                    <!--get your own api key at https://apidocs.pdf.co">https://apidocs.pdf.co-->
                        <input type="hidden" id="api_key_input" name="apiKey" placeholder="API Key" />
                    </p>
                    <!--file upload box-->
                    <div class="input_box">
                        <span class="input_box_pmt">Drop file here or click to upload</span>
                        
                        <input type="hidden" name="MAX_FILE_SIZE" value="8000000" />
                        <input type="file" name="file" class="input_file" hidden>
                    </div>
                    <input class="proceed" type="submit" name="submit" value="Proceed" />
        </form>
    </section>
    <script type="text/javascript" src="../static/dragndrop.js"></script>
</body>

</html>