<?php
session_start();
include 'db_conn.php';
//sets mail to valid
if (!empty($_POST['email'])) { //checks if input is filled
    $email = mysqli_real_escape_string($conn, $_POST['email']); //create a legal SQL string
    $token = mysqli_real_escape_string($conn, $_POST['token']);

    if (!empty($token)) { //checks if empty
        $check_token = "SELECT token FROM login WHERE email = '$email' AND token = '$token'";
        $check_token_run = mysqli_query($conn, $check_token); //query against database

        if (mysqli_num_rows($check_token_run) > 0) { //found an entry
            $update_val = "UPDATE login SET val = 1 WHERE email='$email' AND token = '$token'";
            $update_val_run = mysqli_query($conn, $update_val);
            if ($update_val_run) {
                header("Location: templates/index.php?success=Der Account wurde erfolgreich validiert");
                exit(0);
            } else { //error
                $_SESSION['status'] = "Etwas ist schief gelaufen";
                header("Location: templates/val_mail.php?token=$token&&email=$email");
                exit(0);
            }
        }
    }
} else {
    //no token entered
    $_SESSION['status'] = "Kein Token verfügbar";
    header("Location: templates/index.php?Status Probleme");
    exit(0);
}

?>