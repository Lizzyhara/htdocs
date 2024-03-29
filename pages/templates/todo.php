<?php
session_start();
//Sicherheitscheck
if (
  isset($_SESSION['User'])
) {
  ?>
  <!DOCTYPE html>
  <html>

  <head>
    <title> ToDo </title>
    <link rel="stylesheet" type="text/css" href="../static/css/basic.css">
    <link href="https://fonts.googleapis.com/css2?family=Reenie+Beanie&display=swap" rel="stylesheet"><!--todo font-->
    <link rel="stylesheet" type="text/css" href="../static/css/todo.css">
    <meta name="viewport" content="with=device-wigth, initial-scale=1.0">
  </head>

  <body>
    <section class="background">
      <div class="header" id="header">
        <nav>
          <div class="nav-links">
            <ul>
              <li><a href='home.php'>HOME</a></li>
              <li><a href='to_pdf.php'>PDF KONVERTER</a></li>
              <li><a href='change_password.php'>PASSWORT ÄNDERN</a></li>
              <li><a href='../php/login.php'>LOGOUT</a></li>
            </ul>
          </div>
        </nav>
      </div>
      <div class="center">
        <div class="outer_box">
          <form action="../php/insert.php" method="post"><!--uses insert.php-->
            <h1>ToDo-Liste</h1>
            <?php if (isset($_GET['error'])) { ?>
              <p class="error">
                <?php echo $_GET['error']; ?>
              </p>
            <?php } ?>
            </br>
            <fieldset>
              <input type="text" maxlength="70" id="txt" name="txt"
                placeholder="ToDo Text bis zu 70 Zeichen"><!---text for the todo allows up to 70 characters-->
              <button id="add_btn" type="submit">Hinzugefügen</button>
              </input>
            </fieldset>
          </form>
          <form action="../php/show.php" method="post"><!--uses show.php-->
            <ul id="data">
              <?php include '../php/show.php' ?><!--displays todo text-->
            </ul>

          </form>
        </div>
      </div>

    </section>
  </body>

  </html>
  <?php
} else {
  header("Location: templates/index.php");
  exit();
}
?>