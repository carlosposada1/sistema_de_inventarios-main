<?php
// Incluir archivo de conexión a la base de datos y variables de sesión
require_once "conexion.php";
//require_once "session.php";

// Inicializar variables de error y éxito de inicio de sesión
$error = $success = "";

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtener los datos del formulario
  $usuario = trim($_POST["txtUsuario"]);
  $contrasena = trim($_POST["txtPassword"]);

  // Validar que los campos no estén vacíos
  if (empty($usuario) || empty($contrasena)) {
    $error = "Por favor ingrese un usuario y contraseña.";
  } else {
    // Verificar si las credenciales son correctas
    $sql = "SELECT * FROM usuarios WHERE email = ? AND password = ?";
    $params = array($usuario, $contrasena);
    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) {
      die(print_r(sqlsrv_errors(), true));
    }

    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    if ($row) {
      // Establecer variables de sesión y redirigir al usuario a la página principal
      $_SESSION["id_usuario"] = $row["id_usuario"];
      $_SESSION["usuario"] = $row["usuario"];
      header("Location: home.php");
      exit();
    } else {
      $error = "Credenciales inválidas. Por favor intente de nuevo.";
    }

    // Liberar recursos de la consulta
    sqlsrv_free_stmt($stmt);
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css" />
    <title>Sistema de Inventarios</title>
    
</head>
<body>
    <main>

        <div class="contenedor__todo">
            <div class="caja_trasera">

                <div class="caja_trasera_login">
                    <img class="imagen" src="assets/images/atento.png"  alt="logo">
                    <h3></h3>
                    <p>Bienvenidos al Sistema de Inventarios de Atento.</p>
                    
                </div>
                <div class="caja_trasera_registrar">
                    
                    <h3></h3>
                    <p></p>
                    
                </div>
            </div>
            <div class="contenedor__login-register">
              <?php if ($error): ?>
                <div class="error"><?php echo $error; ?></div>
                <?php endif; ?>
                <form method="POST" class="formulario_login" action="">
                    <img class="imagen_sesion" src="assets/images/atento.png"  alt="logo">
                    <h2>Inicio de Sesión</h2>
                    <h5>Por favor ingrese su Usuario y Contraseña.</h5>
                    <p>Usuario:<input type="text" placeholder="Ingrese su correo" name="txtUsuario"></p>
                    <p>Contraseña:<input type="password" placeholder="Ingrese su contraseña" name="txtPassword"></p>
                    
                    
                    <button id="btn__ingresar"  type="submit">Ingresar</button>
            
                </form>

            </div>
                 
        </div>

    </main>
    
    


</body>
</html>