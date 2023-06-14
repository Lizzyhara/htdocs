<?php
session_start();

include "db_conn.php";
if(isset($_POST['uname']) && isset($_POST['password']) && isset($_POST['name']) && isset($_POST['re_password'])&& isset($_POST['mail'])){
  function validate($data){
    $data= trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  $uname = validate($_POST['uname']);
  $pass = validate($_POST['password']);
  $name = validate($_POST['name']);
  $re_pass = validate($_POST['re_password']);
  $mail = validate($_POST['mail']);

  $user_data = 'uname='.$uname. '&name'. $name;
 
  if(empty($uname)){
    header("Location: templates/signup.php?error=Benutzername muss eingegeben werden&$user_data");
    exit();
  }
  
  else if(empty($pass)){
    header("Location: templates/signup.php?error=Passwort muss eingegeben werden&$user_data");
    exit();
}
else if(empty($name)){
  header("Location: templates/signup.php?error=Name muss eingegeben werden&$user_data");
  exit();
}
else if(empty($mail)){
  header("Location: templates/signup.php?error=Email muss eingegeben werden&$user_data");
  exit();
}
else if(empty($re_pass)){
  header("Location: templates/signup.php?error=RE_Passwort muss einngegeben werden&$user_data");
  exit();
}
else if($pass !== $re_pass){
  header("Location: templates/signup.php?error= Passwort und Re_Passwort sind nicht identisch&$user_data");
  exit();
}

else{

 
      $pass = md5($pass);

    $sql = "SELECT * FROM login WHERE User ='$uname' OR Email = '$mail'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    header("Location: templates/signup.php?error=Der Benutzername wird bereits verwendet&$user_data");
        exit();
  }else {
         $sql2 = "INSERT INTO login( User, Password, Name, Email) VALUES('$uname', '$pass', '$name', '$mail')";
         $result2 = mysqli_query($conn, $sql2);
         if ($result2) {
            header("Location: templates/signup.php?success=Der Account wurde erfolgreich erstellt");
         exit();
         }else {
             header("Location: templates/signup.php?error=unbekannter Fehler ist aufgetreten&$user_data");
          exit();
         }
  }
}
}
else{
  header("Location: templates/signup.php");
  exit();
}