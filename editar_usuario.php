<?php
// Conexión a la base de datos
include 'conexion.php';

// Obtener el ID del usuario a editar
if (isset($_GET['codigo'])) {
    $id = $_GET['codigo'];
} else {
    header("Location: leer_usuario.php");
}

// Obtener los datos del usuario a editar
$sql = "SELECT * FROM usuarios WHERE codigo = ?";
$params = array($id);
$result = sqlsrv_query($conn, $sql, $params);

if (!$result) {
    die("Error al obtener los datos del usuario: " . sqlsrv_errors());
}

if (sqlsrv_has_rows($result)) {
    $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
} else {
    header("Location: leer_usuario.php");
}

// Procesar el formulario cuando se envíe
if (isset($_POST['enviar'])) {
    $id = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];

    $sql = "UPDATE usuarios SET nombre = ?, email = ? WHERE codigo = ?";
    $params = array($nombre, $email, $id);
    $result = sqlsrv_query($conn, $sql, $params);

    if ($result) {
        header("Location: leer_usuario.php");
    } else {
        die("Error al actualizar el usuario: " . sqlsrv_errors());
    }
}

// Cerrar la conexión
sqlsrv_free_stmt($result);
sqlsrv_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
</head>
<body>
    <h1>Editar Usuario</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <input type="hidden" name="codigo" value="<?php echo $row['codigo']; ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $row['nombre']; ?>"><br><br>
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $row['email']; ?>"><br><br>
        <input type="submit" name="enviar" value="Actualizar">
        <a href="leer_usuario.php">Cancelar</a>
    </form>
</body>
</html>
