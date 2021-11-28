<?php
session_start();
require_once("./../config/data.php");
require_once("./../config/config.php");
function go_home() {
header("Location: "."/~grupo11/");
exit();
}

function validateLogin($db, $email, $password){
  // Escribir la función
  $sql = $db->prepare("SELECT * FROM usuario WHERE email = '$email' AND contrasena = '$password';");
  $result = $sql -> execute();
  $result = $sql-> fetchAll(); 
  return $result;
}

?>