<html>
	<head>
		<title>Búsqueda de empleados por clave primaria</title>
		<meta charset="UTF-8">
		<style>
			body {
				font-family: Arial;
			}
			table, th, td {
				border: 1px solid black;
				border-collapse: collapse;
			}
			th, td {
				padding: 5px;
			}
		</style>
		<?php
			$conexion = mysqli_connect('localhost', 'modf', 'modf', 'jardineria');
		?>
	</head>
	<body>
		<h2>Búsqueda de empleados por código</h2>
		<?php
			if (isset($_GET['ENVIAR'])) {
				$codigoEmpleado = $_GET['codigoEmpleado'];
				if (empty($codigoEmpleado)) {
					echo "<h1><mark>ERROR:</mark> El código de empleado es obligatorio</h1>\n";
				} else {
					$consultaEmpleado = mysqli_query($conexion, "SELECT * FROM Empleados WHERE CodigoEmpleado = '$codigoEmpleado'");
					if (mysqli_num_rows($consultaEmpleado) == 1) {
						echo "<table>\n";
						echo "<tr>\n";
						echo "<th>Nombre completo</th>\n";
						echo "<th>Extensión</th>\n";
						echo "<th>Correo electrónico</th>\n";
						echo "<th>Oficina</th>\n";
						echo "<th>Nombre de jefe</th>\n";
						echo "<th>Puesto</th>\n";
						echo "</tr>\n";
						$empleado = mysqli_fetch_array($consultaEmpleado);
						$consultaEmpleadoJefe = mysqli_query($conexion, "SELECT CONCAT(Nombre, ' ', Apellido1, ' ', Apellido2) AS nombreCompleto FROM Empleados WHERE CodigoEmpleado = '" . $empleado['CodigoJefe'] . "'");
						$jefe = mysqli_fetch_array($consultaEmpleadoJefe);
						echo "<tr>\n";
						echo "<td>" . $empleado['Nombre'] . " " . $empleado['Apellido1'] . " " . $empleado['Apellido2'] . "</td>\n";
						echo "<td>" . $empleado['Extension'] . "</td>\n";
						echo "<td>" . $empleado['Email'] . "</td>\n";
						echo "<td>" . $empleado['CodigoOficina'] . "</td>\n";
						echo "<td><a href='" . $_SERVER['PHP_SELF'] . "?codigoEmpleado=" . $empleado['CodigoJefe'] . "&ENVIAR=Realizar+búsqueda'>" . $empleado['CodigoJefe'] . " - " . $jefe['nombreCompleto'] . "</td>\n";
						echo "<td>" . $empleado['Puesto'] . "</td>\n";
						echo "</tr>\n";
						echo "</table>\n";
						mysqli_free_result($consultaEmpleado);
						mysqli_free_result($consultaEmpleadoJefe);
						echo "<br>\n";
						echo "<a href='" . $_SERVER['PHP_SELF'] . "'>Volver al formulario</a>\n";
					} else {
						echo "<h2>No se ha encontrado ningún empleado con el código " . $codigoEmpleado . "</h2>\n";
					}
				}
			} else {
		?>
		<form action="<?php $_SERVER['PHP_SELF'] ?>" method="GET">
			<input type="text" placeholder="Escribe aquí un código de empleado" name="codigoEmpleado">
			<input type="submit" name="ENVIAR" value="Realizar búsqueda">
		</form>
		<?php
			}
			mysqli_close($conexion);
		?>
	</body>
</html>