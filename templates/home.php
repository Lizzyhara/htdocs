<?php
session_start();
if (
	isset($_SESSION['User'])
) {
	?>
	<!DOCTYPE html>
	<html>
	<!--Homepage-->
	<head>
		<title> Home </title>
		<link rel="stylesheet" type="text/css" href="../static/home.css">
		<link rel="stylesheet" type="text/css" href="../static/basic.css">
		<meta name="viewport" content="with=device-wigth, initial-scale=1.0">
	</head>

	<body>
		<section class="background">
			<div class="playgif"> <!--used to show a GIF (css)-->
			</div>
			<div class="header" id="header">
				<nav>
					<div class="nav-links">
						<ul>
							<li><a href='to_pdf.php'>PDF KONVERTER</a></li>
							<li><a href='to_pdf.php'>TODO</a></li>
							<li><a href='change_password.php'>PASSWORT ÄNDERN</a></li>
							<li><a href='../login.php'>LOGOUT</a></li>
						</ul>
					</div>
				</nav>
			</div>
			<div class="center">
				<div class="box">
					<h1> Guten Tag
						<?php echo $_SESSION['Name'] ?>!<!--shows users name -->
					</h1>
					<!--shows page content-->
					<p>
					<h2> Viel Erfolg beim Arbeiten!</h2>
					</p>
					<div id="right_side">
						<h3>Wofür dient die Seite</h3>
						<p>Diese Seite soll dir bei Altagsproblemen zur Seite stehen. Du kannst hier sowohl aufschreiben was
							du noch zu erledigen hast, als auch ein .docxs Dokument in ein PDF umzuwandeln.</p>
					</div>
					<img src="../img/x-to-pdf.png" id="img-left">
					<p></p>
					<div id="left_side">
						<h3>PDF Konverter</h3>
						<p>Dieses Tool soll dir dabei helfen deine DOXCS Datein einfach zu einen PDF zu konvertieren.</p>
					</div>
					<img src="../img/toDoimg.png" id="img-right">
					<div id="left_side" style="background-color:aquamarine;">
						<h3>ToDo-Liste</h3>
						<p style="font-weight: normal">Jeder hat manchmal Probleme seine Aufgaben zu ordnen, mit dem Tool
							ist dies in der Vergangenheit, du kannst all deine Aufgaben notieren.</p>
					</div>
				</div>
		</section>
		<script type="text/javascript" src="../static/header.js"></script><!--uses javascript-->
	</body>

	</html>
	<?php
} else {
	header("Location: index.php");
	exit();
}
?>