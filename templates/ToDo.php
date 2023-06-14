<?php
session_start();
if(isset($_SESSION['User'])
)
{
//Db Sachen entnommen und homepage design

?>
<!DOCTYPE html>
<html>
  <head>
    <title> Home </title>
    <link rel="stylesheet" type="text/css" href="../static/basic.css">
    <link href="https://fonts.googleapis.com/css2?family=Reenie+Beanie&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../static/todo.css">
    <meta name="viewport" content="with=device-wigth, initial-scale=1.0">
  </head>
  <body>
  <section class="background">
    <div class="header" id="header">
        <nav>
            <div class="nav-links">
                <ul>
                    <li><a href='home.php'>HOME</a></li>
                    <li><a href='sample.php'>PDF KONVERTER</a></li>
                    <li><a href='change-password.php'>PASSWORT ÄNDERN</a></li>
                    <li><a href='../login.php'>LOGOUT</a></li>
                </ul>
            </div>
        </nav>
    </div>
		<div class="center">
      <div class="outer_box">
        <form action="../insert.php" method="post">
                <h1>ToDo-Liste</h1>
                </br>
          <fieldset>
          <input type ="text" id="txt" name="txt" placeholder="ToDo Text">
            <button id="add_btn"type="submit">Hinzugefügen</button>
          </input>
          </fieldset>
        </form>
        <form action="../show.php" method="post">
          <ul id="data">
              <?php include '../show.php' ?>
          </ul>
        
        </form>
      </div>
		</div>

	</section>
  </body>
</html>
<?php
}
else{
	header("Location: templates/index.php");
    exit();
}
?>