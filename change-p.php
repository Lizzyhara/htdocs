<?php 
session_start();

if (isset($_SESSION['User'])) {

    include "db_conn.php";

if (isset($_POST['np'])
    && isset($_POST['c_np'])) {

	function validate($data){
     $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}


	$np = validate($_POST['np']);
	$c_np = validate($_POST['c_np']);
    //nach leeren Feldern geschaut
    
    if(empty($np)){
      header("Location: templates/change-password.php?error=Das neue Passwort muss eingetragen werden");
	  exit();
    }else if($np !== $c_np){
      header("Location: templates/change-password.php?error=Das neue Passwort muss bestätigt werden");
	  exit();
    }else {
    	// md5 hashfunktion
    	
    	$np = md5($np);
        $id = $_SESSION['ID'];
		//Einloggen und updaten
        $sql = "SELECT password
                FROM login WHERE 
                ID='$id'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) === 1){
        	
        	$sql_2 = "UPDATE login
        	          SET Password='$np'
        	          WHERE ID='$id'";
        	mysqli_query($conn, $sql_2);
        	header("Location: templates/change-password.php?success=Dein Passwort wurde erfolgreich geändert");
	        exit();

        }else {
        	header("Location: templates/change-password.php?error=Falsches Passwort");
	        exit();
        }

    }
	}else{
		header("Location: templates/change-password.php");
		exit();
	}

}else{
     header("Location: templates/index.php");
     exit();
}
//rest ist Fehlerberücksichtigen 