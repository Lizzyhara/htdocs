<?php
session_start();
//checks the information entered during registration
include "db/db_conn.php";
if (isset($_POST['uname']) && isset($_POST['password']) && isset($_POST['name']) && isset($_POST['re_password']) && isset($_POST['mail'])) {
  function validate($data)
  {
    //clean up data
    $data = trim($data); //whitespace is stripped
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  //initialize userdata
  $uname = validate($_POST['uname']);
  $pass = validate($_POST['password']);
  $name = validate($_POST['name']);
  $re_pass = validate($_POST['re_password']);
  $mail = validate($_POST['mail']);

  $user_data = 'uname=' . $uname . '&name' . $name;
  //tests if all inputs are filled, sends an error if not
  if (empty($uname)) {
    header("Location: templates/signup.php?error=Benutzername muss eingegeben werden&$user_data");
    exit();
  } else if (empty($pass)) {
    header("Location: templates/signup.php?error=Passwort muss eingegeben werden&$user_data");
    exit();
  } else if (empty($name)) {
    header("Location: templates/signup.php?error=Name muss eingegeben werden&$user_data");
    exit();
  } else if (empty($mail)) {
    header("Location: templates/signup.php?error=Email muss eingegeben werden&$user_data");
    exit();
  } else if (empty($re_pass)) {
    header("Location: templates/signup.php?error=RE_Passwort muss einngegeben werden&$user_data");
    exit();
  } else if ($pass !== $re_pass) {
    header("Location: templates/signup.php?error= Passwort und Re_Passwort sind nicht identisch&$user_data");
    exit();
  } else {


    $pass = md5($pass); //encryption

    $sql = "SELECT * FROM login WHERE User ='$uname'"; //SQL request
    $result0 = mysqli_query($conn, $sql); //query against database
    if (mysqli_num_rows($result0) > 0) { //if there is an entry in the database
      header("Location: templates/signup.php?error=Der Benutzername wird bereits verwendet&$user_data");
      exit();
    } else {
      //same as before
      $sql1 = "SELECT * FROM login WHERE Email = '$mail'";
      $result1 = mysqli_query($conn, $sql1);
      if (mysqli_num_rows($result1) > 0) {
        header("Location: templates/signup.php?error=Die Email wird bereits verwendet&$user_data");
        exit();
      } else {
        $sql2 = "INSERT INTO login( User, Password, Name, Email) VALUES('$uname', '$pass', '$name', '$mail')"; //insert the user into the database
        $result2 = mysqli_query($conn, $sql2);
        if ($result2) {
          header("Location: templates/validate.php?success=Der Account wurde erfolgreich erstellt und muss nur noch validiert werden");
          exit();
        } else {
          header("Location: templates/signup.php?error=Ein unbekannter Fehler ist aufgetreten&$user_data");
          exit();
        }
      }
    }
  }
} else {
  header("Location: templates/signup.php");
  exit();
}