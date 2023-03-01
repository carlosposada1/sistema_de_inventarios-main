<?php
// Conexión a la base de datos
include 'conexion.php';

// Obtención del id del usuario a eliminar
if (isset($_GET["codigo"])) {
    $id = $_GET["codigo"];
} else {
    die("No se especificó el id del usuario a eliminar.");
}

// Eliminación del usuario
$sql = "DELETE FROM usuarios WHERE codigo = ?";
$params = array($id);
$stmt = sqlsrv_prepare($conn, $sql, $params);

if (!$stmt) {
    die("Error al preparar la consulta: " . sqlsrv_errors());
}

if (!sqlsrv_execute($stmt)) {
    die("Error al ejecutar la consulta: " . sqlsrv_errors());
}

// Redirección a la página de lectura de usuarios
header("Location: leer_usuario.php");
exit;
