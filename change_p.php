<?php
session_start();
//changes password when user is logged in
if (isset($_SESSION['User'])) {

	include "db/db_conn.php";
	//checks if both inputs are filled
	if (
		isset($_POST['np'])
		&& isset($_POST['c_np'])
	) {

		function validate($data)
		{
			//cleans the data
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}


		$np = validate($_POST['np']);
		$c_np = validate($_POST['c_np']);
		//nach leeren Feldern geschaut

		if (empty($np)) {
			header("Location: templates/change_password.php?error=Das neue Passwort muss eingetragen werden");
			exit();
		} else if ($np !== $c_np) {
			header("Location: templates/change_password.php?error=Die Passwörter müssen gleich sein");
			exit();
		} else {
			// md5 hashfunction encryption

			$np = md5($np);
			$id = $_SESSION['ID'];
			$sql = "SELECT password
                FROM login WHERE 
                ID='$id'";
			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) === 1) { //user found
				//updates password
				$sql_2 = "UPDATE login
        	          SET Password='$np'
        	          WHERE ID='$id'";
				mysqli_query($conn, $sql_2);
				header("Location: templates/change_password.php?success=Dein Passwort wurde erfolgreich geändert");
				exit();

			} else {
				header("Location: templates/change_password.php?error=Falsches Passwort");
				exit();
			}

		}
	} else {
		header("Location: templates/change_password.php");
		exit();
	}

} else {
	header("Location: templates/index.php");
	exit();
}