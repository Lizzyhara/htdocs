<?php
//connects to the database XXAMP is used
$sname = "localhost";
$unmae = "root";
$password = "";

$db_name = "littlehelperdb";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
  echo "Connection failed!";
}
//db connection faild error