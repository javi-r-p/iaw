<html>
	<head>
		<title>Gestión de empleados</title>
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
				padding: 10px;
			}
		</style>
		<?php
			$conexion = mysqli_connect('localhost', 'modf', 'modf', 'jardineria');
		?>
	</head>
	<body>
		<?php
			if (isset($_POST['ENVIAR'])) {
				$codigoEmpleado = $_POST['codigoEmpleado'];
				$consultaEmpleado = mysqli_query($conexion, "SELECT * FROM Empleados WHERE CodigoEmpleado = $codigoEmpleado");
				$empleado = mysqli_fetch_array($consultaEmpleado);
				$consultaOficina = mysqli_query($conexion, "SELECT CONCAT(Ciudad, ', ', Pais) AS Ubicacion FROM Oficinas WHERE CodigoOficina = '" . $empleado['CodigoOficina'] . "'");
				$oficina = mysqli_fetch_array($consultaOficina);
				$consultaJefe = mysqli_query($conexion, "SELECT CONCAT(Nombre, ' ', Apellido1, ' ', Apellido2) AS NombreCompleto FROM Empleados WHERE CodigoJefe = " . $empleado['CodigoJefe']);
				$jefe = mysqli_fetch_array($consultaJefe);
				function consulta () {
					global $empleado;
					global $oficina;
					global $jefe;
					echo "<table>\n";
						echo "<tr>\n";
							echo "<th>Nombre completo</th>\n";
							echo "<th>Extensión</th>\n";
							echo "<th>Dirección de correo electrónico</th>\n";
							echo "<th>Oficina - Código</th>\n";
							echo "<th>Jefe - Código</th>\n";
							echo "<th>Puesto</th>\n";
						echo "</tr>\n";
						echo "<tr>\n";
							echo "<td>" . $empleado['Nombre'] . " " . $empleado['Apellido1'] . " " . $empleado['Apellido2'] . "</td>\n";
							echo "<td>" . $empleado['Extension'] . "</td>\n";
							echo "<td>" . $empleado['Email'] . "</td>\n";
							echo "<td>" . $oficina['Ubicacion'] . " - " . $empleado['CodigoOficina'] . "</td>\n";
							echo "<td>" . $jefe['NombreCompleto'] . " - " . $empleado['CodigoJefe'] . "</td>\n";
							echo "<td>" . $empleado['Puesto'] . "</td>\n";
						echo "</tr>\n";
					echo "</table>\n";
					echo "<br>\n";
					echo "<a href='" . $_SERVER['PHP_SELF'] . "'>Volver al formulario</a>";
				}
				if (mysqli_num_rows($consultaEmpleado) == 0) {
					echo "<h1>No existe ese empleado</h1>";
					echo "<a href='" . $_SERVER['PHP_SELF'] . "'>Volver</a>";
				}
				switch ($_POST['accion']) {
					case "insertar":
						break;
					case "modificar":
						break;
					case "eliminar":
						
						break;
					case "consultar":
						consulta();
						break;
				}
			} else {
		?>
			<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
				<label>Código del empleado</label><input type="number" name="codigoEmpleado">
				<br>
				<input type="radio" name="accion" value="insertar"><label>Dar de alta un empleado</label>
				<br>
				<input type="radio" name="accion" value="modificar"><label>Modificar los datos de un empleado</label>
				<br>
				<input type="radio" name="accion" value="eliminar"><label>Eliminar un empleado</label>
				<br>
				<input type="radio" name="accion" value="consultar"><label>Consultar los datos de un empleado</label>
				<br>
				<input type="submit" name="ENVIAR" value="Iniciar aplicación">
			</form>
		<?php
			}
			mysqli_close($conexion);
		?>
	</body>
</html>