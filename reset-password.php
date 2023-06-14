/** 
<?php
session_start();
include 'db_conn.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
  require 'vendor/PHPMailer/PHPMailer/src/Exception.php';
  require 'vendor/PHPMailer/PHPMailer/src/PHPMailer.php';
  require 'vendor/PHPMailer/PHPMailer/src/SMTP.php';

  if(isset($_POST['mail'])){

  $email = mysqli_real_escape_string($conn, $_POST['mail']);
  $token= md5(rand());

  $check_email = "SELECT email FROM login WHERE email='$email' LIMIT 1";
  $check_email_run = mysqli_query($conn, $check_email);

  if(mysqli_num_rows($check_email_run)>0){
    $row=mysqli_fetch_array($check_email_run);
    $get_name = $row['Name'];
    $get_email = $row['email'];
    $update_token= "UPDATE login SET token = '$token' WHERE email = '$get_email' LIMIT 1";
    $update_token_run = mysqli_query($conn, $update_token);
    if($update_token_run){
         
    $host = "smtp.gmail.com";
    $port = 587;
    $secure = "tls";
    //  or the following configurations through SSL should work as well. 
    //  $port = 465;
    //  $secure = "ssl";
    $username = "liz.wellhausen@gmail.com";
    $password = "qbuzvtpfqvxrfjem";
  
    try {
        $mailer = new PHPMailer(true);
        $mailer->IsHTML(true);
        $mailer->IsSMTP();
        $mailer->From = $username;
        $mailer->FromName = $username;
        $mailer->ClearAllRecipients();
        $mailer->AddAddress($get_email, $get_name);
        $mailer->Subject = "Subject ";
        $mailer -> isHTML(true);
        $mailer->Body = "<h1>Hey,<h1>
                        <p>hier ist der Link zum zurücksetzen deines Passworts.</p></br>
                        <a href='localhost/templates/change_with_mail.php?token=$token&email=$email'>Hier klicken</a>";
        $mailer->SMTPAuth   = true;       // enable SMTP authentication
        $mailer->SMTPSecure = $secure;    // sets the prefix to the servier
        $mailer->Host       = $host;      // sets GMAIL as the SMTP server
        $mailer->Port       = $port;      // set the SMTP port for the GMAIL server
        $mailer->Username   = $username;  // GMAIL username
        $mailer->Password   = $password;  // GMAIL password
        $result = $mailer->Send();  
        echo header("Location: templates/reset_p.php");
        exit();
    } catch  (Exception $e) {
        echo header("Location: templates/reset_p.php?error=Email konnte nicht gesendet werden");
        exit();
    }
    }
    else{
        echo header("Location: templates/reset_p.php?error=Etwas ist schief gelaufen");
        exit();
    }
  }
  else{
    echo header("Location: templates/reset_p.php?error=Email wurde nicht gefunden");
    exit();
  }
  
}
  else{
    echo header("Location: templates/reset_p.php?error=Email muss angegeben werden");
    exit();
  }