<?php
session_start();
include 'db_conn.php';
if(isset($_POST['txt'])){
function validate($data){
    $data= trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
$txt = validate($_POST['txt']);
$id = $_SESSION['ID'];
$sql = "INSERT INTO todo ( UserID,Text ) VALUES($id ,'$txt')";
$result = mysqli_query($conn, $sql);
if($result){
    header("Location: templates/ToDo.php?success=ToDo erfolgreich hinzugefügt");
}
else{
    echo "Error : ($sql}" .mysqli_error($conn);
}
}
else{
    echo "Error";
}
?>