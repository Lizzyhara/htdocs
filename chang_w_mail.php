<?php
session_start();
include 'db/db_conn.php';
//changes password when mail link was requested
if (isset($_POST['email']) && isset($_POST['new_pass']) && isset($_POST['con_pass'])) { //checks if all inputs are enterd

  $email = mysqli_real_escape_string($conn, $_POST['email']); //create a legal SQL string
  $new_pass = mysqli_real_escape_string($conn, $_POST['new_pass']); //create a legal SQL string
  $con_pass = mysqli_real_escape_string($conn, $_POST['con_pass']); //create a legal SQL string
  $token = mysqli_real_escape_string($conn, $_POST['token']); //create a legal SQL string

  if (empty($email)) { //checks if inputs are empty
    header("Location: templates/change_with_mail.php?error=Es gibt ein Problem mit der Mail");
    exit();
  } else if (empty($new_pass)) {
    header("Location: templates/change_with_mail.php?error=Gebe ein neues Passwort ein");
    exit();
  } else if (empty($con_pass)) {
    header("Location: templates/change_with_mail.php?error=Gebe die Bestätigung des Pasworts ein");
    exit();
  }
  if (!empty($token)) { //checks if token is entered
    $check_token = "SELECT token FROM login WHERE email = '$email' AND token = '$token'";
    $check_token_run = mysqli_query($conn, $check_token); //query against database

    if (mysqli_num_rows($check_token_run) > 0) {
      if ($new_pass == $con_pass) { //if both entered passwords are the same
        $pass = md5($new_pass); //encryption
        $update_password = "UPDATE login SET Password = '$pass' WHERE email='$email' AND token = '$token'";
        $update_password_run = mysqli_query($conn, $update_password);
        if ($update_password_run) { //update was successful
          header("Location: templates/index.php?success=Das Passwort wurde geändert");
          exit(0);
        } else {
          $_SESSION['status'] = "Etwas ist schief gelaufen";
          header("Location: templates/change_with_mail.php?token=$token&&email=$email");
          exit(0);
        }
      } else {
        $_SESSION['status'] = "Passwörter müssen übereinstimmen";
        header("Location: templates/change_with_mail.php?error=Passwörter müssen übereinstimmen");
        exit(0);
      }
    } else {
      $_SESSION['status'] = "Falscher Token oder Email";
      header("Location: templates/change_with_mail.php?eror=Falscher Token oder falsche Email");
      exit(0);
    }
  } else {
    //error
    $_SESSION['status'] = "Kein Token verfügbar";
    header("Location: templates/reset_password.php?error=Kein Token verfügbar");
    exit(0);
  }

}
?>