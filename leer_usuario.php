<!DOCTYPE html>
<html>
<head>
	<title>Usuarios</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
	<div class="container-fluid">
		<h1>Usuarios</h1>
		<!-- <a href="indexexcel.php" class="btn btn-primary mb-2">Importar Excel</a> -->
        <a href="descargar-estadisticas.php" class="btn btn-primary mb-2">Descargar Estadisticas</a>
		<a href="logout.php" class="btn btn-primary mb-2">Cerrar Sesion</a>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Código</th>
					<th>Nombre</th>
					<th>Correo Electrónico</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				<?php
					include 'conexion.php';

					// Consulta para obtener los usuarios
					$query = "SELECT * FROM usuarios";
					$result = sqlsrv_query($conn, $query);

					if (sqlsrv_has_rows($result)) {
						while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
							// Imprimir los datos del usuario en la tabla
							echo "<tr>";
							echo "<td>".$row['codigo']."</td>";
							echo "<td>".$row['nombre']."</td>";
							echo "<td>".$row['email']."</td>";
							echo "<td>";
							echo "<a href='editar_usuario.php?codigo=".$row['codigo']."' class='btn btn-info mr-2'>Editar</a>";
							echo "<a href='eliminar_usuario.php?codigo=".$row['codigo']."' class='btn btn-danger'>Eliminar</a>";
							echo "</td>";
							echo "</tr>";
						}
					} else {
						echo "<tr><td colspan='4'>No se encontraron usuarios</td></tr>";
					}

					// Cerrar conexión a la base de datos
					sqlsrv_free_stmt($result);
					sqlsrv_close($conn);
				?>
			</tbody>
		</table>
	</div>
</body>
</html>
