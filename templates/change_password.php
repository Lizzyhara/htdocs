<?php
session_start();
//Aussehen von Change Password und nutzvolle Interaktionen
if (isset($_SESSION['User'])) {

	?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Change Password</title>
		<link rel="stylesheet" type="text/css" href="../static/login.css">
	</head>

	<body>
		<section class="background">
			<form action="change_p.php" method="post"><!--ueses change_p.php-->
				<h2>Passwort ändern</h2><!--checks for errors-->
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
				<!--input for new passsword-->
				<label>Neues Passwort</label>
				<input type="password" name="np" placeholder="Neues Passwort">
				<br>
				<!--input for check passsword-->
				<label>Bestätigung Neues Passwort</label>
				<input type="password" name="c_np" placeholder="Bestätigung Neues Passwort">
				<br>

				<button type="submit">Ändern</button>
				<a href="home.php" class="ca">Home</a>
			</form>
		</section>
	</body>

	</html>

<?php
} else {
	header("Location: index.php");
	exit();
}
?>