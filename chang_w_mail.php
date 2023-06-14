<?php
session_start();
include 'db_conn.php';

if(isset($_POST['email']) && isset($_POST['new_pass']) && isset($_POST['con_pass'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $new_pass = mysqli_real_escape_string($conn, $_POST['new_pass']);
    $con_pass = mysqli_real_escape_string($conn, $_POST['con_pass']);
    $token = mysqli_real_escape_string($conn, $_POST['token']);
    if(empty($email)){
      header("Location: templates/change_with_mail.php?token=$token&&email=$email");
      exit();
    }
    else if(empty($new_pass)){
        header("Location: templates/change_with_mail.php?token=$token&&email=$email");
        exit();
    }
    else if(empty($con_pass)){
      header("Location: templates/change_with_mail.php?token=$token&&email=$email");
      exit();
  }
  if(!empty($token)){
    $check_token = "SELECT token FROM login WHERE email = '$email' AND token = '$token'";
    $check_token_run = mysqli_query($conn, $check_token);

    if(mysqli_num_rows($check_token_run) > 0){
        if($new_pass == $con_pass)
        {
            $pass = md5($new_pass);
            $update_password = "UPDATE login SET Password = '$pass' WHERE email='$email' AND token = '$token'";
            $update_password_run = mysqli_query($conn, $update_password);
            if($update_password_run){
                header("Location: templates/index.php");
                exit(0);
            }
            else {
                $_SESSION['status']="Etwas ist schief gelaufen";
                header("Location: templates/change_with_mail.php?token=$token&&email=$email");
                exit(0);
            }
        }   
        else{
         $_SESSION['status']="Passwörter müssen übereinstimmen";
        header("Location: templates/change_with_mail.php?token=$token&&email=$email");
        exit(0);
        }
    }
    else{
        $_SESSION['status']="Falscher Token oder Email";
        header("Location: templates/change_with_mail.php?token=$token&&email=$email");
        exit(0);
    }
  }
  else{
    $_SESSION['status']="Kein Token verfügbar";
    header("Location: templates/reset_p.php");
    exit(0);
  }

}
?>