<?php
// Change the password
include_once('./../__init__.php');
require_once("./../layout/header2.php");
require('./error_msg.php');
require('./success_msg.php');

$request_method = filter_input(INPUT_SERVER, 'REQUEST_METHOD');
if ($request_method === "POST"){
  $old_pass = $_POST['old_pass'];
  $new_pass = $_POST['new_pass'];
  $confirm_new_pass = $_POST['confirm_pass'];
  $status1 = $old_pass === $_SESSION['contrasena'];
  $status2 = $new_pass === $confirm_new_pass;

  $uid = $_SESSION['uid'];
  if ($status1 && $status2 && strlen($new_pass) > 4) {
    $query = $db -> prepare(
      "UPDATE usuario
      SET contrasena = '{$confirm_new_pass}' 
      WHERE uid = {$uid};");
    $result = $query -> execute();
    $_SESSION['contrasena'] = $new_pass;
    successMsg("Contraseña cambiada exitosamente");
  } else {
    errorMsg("No se pudo cambiar la contraseña");
  };
};

?>