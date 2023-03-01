<?php
// Incluir archivo de conexión a la base de datos y variables de sesión
require_once "conexion.php";
//require_once "session.php";

// Destruir sesión actual
session_destroy();

// Redirigir al usuario a la página de inicio de sesión
header("Location: index.php");
exit();
?>