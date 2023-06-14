<?php
session_start();

include "db_conn.php";
if(isset($_POST['uname']) && isset($_POST['password'])){
  function validate($data){
    $data= trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  $uname = validate($_POST['uname']);
  $pass = validate($_POST['password']);
  $pass = md5($pass);
  if(empty($uname)){
    header("Location: templates/index.php?error=Benutzername muss eingegeben werden");
    exit();
  }
  else if(empty($pass)){
    header("Location: templates/index.php?error=Passwort muss eingegeben werden");
    exit();
}
else{
  //User wird gesucht und eingeloggt
  $sql = "SELECT * FROM login WHERE User ='$uname' AND Password ='$pass'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) === 1){
      $row = mysqli_fetch_assoc($result);
      if($row['User'] === $uname && $row['Password'] === $pass ){
        $_SESSION['User'] = $row['User'];
        $_SESSION['ID'] = $row['ID'];
        $_SESSION['Name'] = $row['Name'];
        $_SESSION['Email'] = $row['Name'];
        header("Location: templates/home.php");
        exit();
      }
      else{
        header("Location: templates/index.php?error=Sie haben einen falschen Benutzernamen oder ein falsches Passwort eingegeben $pass");
        exit();
      }
  }
  else{
    header("Location: templates/index.php?error=Sie haben einen falschen Benutzernamen oder ein falsches Passwort eingegeben.");
    exit();
  }
} 
}
else{
  header("Location: templates/index.php");
  exit();
}

