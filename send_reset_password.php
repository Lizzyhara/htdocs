<?php
//sends mail to reset password
session_start();
include 'db/db_conn.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
require 'vendor/PHPMailer/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/PHPMailer/src/SMTP.php';

if (isset($_POST['mail'])) {

  $email = mysqli_real_escape_string($conn, $_POST['mail']); //create a legal SQL string
  $token = md5(rand()); //encryption

  $check_email = "SELECT email FROM login WHERE email='$email' LIMIT 1"; //SQL request
  $check_email_run = mysqli_query($conn, $check_email); //query against database

  if (mysqli_num_rows($check_email_run) > 0) { //entry found
    $row = mysqli_fetch_array($check_email_run);
    //email is send to
    $get_name = $row['Name'];
    $get_email = $row['email'];
    $update_token = "UPDATE login SET token = '$token' WHERE email = '$get_email' LIMIT 1";
    $update_token_run = mysqli_query($conn, $update_token);
    if ($update_token_run) {
      
      $host = "smtp.gmail.com";
      $port = 587;
      $secure = "tls";
      $username = "liz.wellhausen@gmail.com"; //email is send from, you can use your own email here if needed
      $password = "qqlhuebattsprzbn"; //app password

      try {
        $mailer = new PHPMailer(true);
        //initialize mailer
        $mailer->IsHTML(true);
        $mailer->IsSMTP();
        $mailer->From = $username;
        $mailer->FromName = $username;
        $mailer->ClearAllRecipients(); //make sure just one intended address gets mail
        $mailer->AddAddress($get_email, $get_name);
        $mailer->Subject = "Subject ";
        $mailer->isHTML(true);
        $mailer->Body = "<h1>Hey,<h1>
                        <p>hier ist der Link zum Zurücksetzen deines Passworts.</p></br>
                        <a href='localhost/templates/change_with_mail.php?token=$token&email=$email'>Hier klicken</a>"; //mail text
        $mailer->SMTPAuth = true; // enable SMTP authentication
        $mailer->SMTPSecure = $secure; // sets the prefix to the servier
        $mailer->Host = $host; // sets GMAIL as the SMTP server
        $mailer->Port = $port; // set the SMTP port for the GMAIL server
        $mailer->Username = $username; // GMAIL username
        $mailer->Password = $password; // GMAIL password
        $result = $mailer->Send();
        echo header("Location: templates/reset_password.php");
        exit();
      } catch (Exception $e) {
        echo header("Location: templates/reset_password.php?error=Email konnte nicht gesendet werden");
        exit();
      }
    } else {
      echo header("Location: templates/reset_password.php?error=Etwas ist schief gelaufen");
      exit();
    }
  } else {
    echo header("Location: templates/reset_password.php?error=Email wurde nicht gefunden");
    exit();
  }

} else {
  echo header("Location: templates/reset_password.php?error=Email muss angegeben werden");
  exit();
}