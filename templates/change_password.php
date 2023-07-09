<?php
session_start();
//change password when logged into your account
if (isset($_SESSION['User'])) {

	?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Change password without mail </title>
		<link rel="stylesheet" type="text/css" href="../static/login.css">
		<link rel="stylesheet" type="text/css" href="../static/basic.css">
	</head>

	<body>
		<section class="background"><!--header-->
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
			<div class="center">
				<form action="..\change_p.php" method="post"><!--uses change_p.php-->
					<h2>Passwort ändern</h2><!--displays errors-->
					<?php if (isset($_GET['error'])) { ?>
						<p class="error">
							<?php echo $_GET['error']; ?>
						</p>
					<?php } ?>
					<!--display success-->
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
			</div>
		</section>
	</body>

	</html>

	<?php
} else {
	header("Location: index.php");
	exit();
}
?>