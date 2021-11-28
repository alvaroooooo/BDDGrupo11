<?php
session_start();
require_once("./config/data.php");
require_once("./config/config.php");
function go_home() {
header("Location: "."/~grupo11/");
exit();
}
