<?php
include_once('./../__init__.php');
$request_method = filter_input(INPUT_SERVER, 'REQUEST_METHOD');

if ($request_method !== "POST") {
  go_home();
}
require_once("./../layout/header2.php");
require('./error_msg.php');
require('./sucess_msg2.php');
?> 

<div style="margin-top: 120px;"> </div>

<?php 
$nombre = $_POST['nombre'];
$username = $_POST['username'];
$email = $_POST['email'];
$contrasena = $_POST['password'];
$confirm_contrasena = $_POST['confirm_password'];

if ($contrasena === $confirm_contrasena && strlen($contrasena) > 4) {
  $query = $db -> prepare(
  "SELECT *
  FROM usuario
  WHERE email = '{$email}';");
  $result = $query -> execute();
  $result = $query -> fetchAll();

  if (empty($result[0])) {
    $query = $db->prepare(
      "SELECT MAX(uid)
      FROM usuario;"
    );
    $result = $query->execute();
    $result = $query->fetchAll();

    $new_id = $result[0][0] + 1;
    $query_register = $db -> prepare(
      "INSERT INTO usuario VALUES({$new_id}, '{$nombre}', '{$email}', '{$contrasena}', '{$username}');");
    $query_register -> execute();
    successMsg2("Usuario creado exitosamente, bienvenido {$nombre}, ahora haz el login normal");
  } else {
    errorMsg("El username o correo ya esta registrado, intente con otro");
  };
} else {
  errorMsg("La contraseña no coincide o es tiene 4 o menos caracteres");
};

?> 