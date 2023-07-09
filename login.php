<?php
session_start();
//checks entered information
include "db/db_conn.php";
if (isset($_POST['uname']) && isset($_POST['password'])) {
  function validate($data)
  {
    //clean up data
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $uname = validate($_POST['uname']);
  $pass = validate($_POST['password']);
  $pass = md5($pass); //encryption
  //check if all inputs are filled
  if (empty($uname)) {
    header("Location: templates/index.php?error=Benutzername muss eingegeben werden");
    exit();
  } else if (empty($pass)) {
    header("Location: templates/index.php?error=Passwort muss eingegeben werden");
    exit();
  } else {
    //userinformation is checked
    $sql = "SELECT * FROM login WHERE User ='$uname' AND Password ='$pass'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) === 1) { //found a user
      $row = mysqli_fetch_assoc($result);
      if ($row['User'] === $uname && $row['Password'] === $pass) { //doublechecks information
        if ($row['Val'] != 1) { //checks if mail is valid
          header("Location: templates/index.php?error=Sie müssen ihre Email noch validieren");
          exit();
        }
        $_SESSION['User'] = $row['User'];
        $_SESSION['ID'] = $row['ID'];
        $_SESSION['Name'] = $row['Name'];
        $_SESSION['Email'] = $row['Name'];
        header("Location: templates/home.php");
        exit();
      } else {
        header("Location: templates/index.php?error=Sie haben einen falschen Benutzernamen oder ein falsches Passwort eingegeben $pass");
        exit();
      }

    } else {
      header("Location: templates/index.php?error=Sie haben einen falschen Benutzernamen oder ein falsches Passwort eingegeben.");
      exit();
    }
  }
} else {
  header("Location: templates/index.php");
  exit();
}