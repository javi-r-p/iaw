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
			input[type=number]::-webkit-outer-spin-button,
			input[type=number]::-webkit-inner-spin-button {
				-webkit-appearance: none;
				margin: 0;
			}
			input[type=number] {
				-moz-appearance: textfield;
			}
		</style>
		<?php
			$conexion = mysqli_connect('localhost', 'modf', 'modf', 'jardineria');
		?>
	</head>
	<body>
		<?php
			if (isset($_GET['ENVIAR'])) {
				switch ($_GET['accion']) {
					case "insertar":
						if (isset($_POST['INSERTAR'])) {
							mysqli_query($conexion, "INSERT INTO Empleados VALUES (" . $_POST['codigoEmpleado'] . ", '" . $_POST['nombre'] . "', '" . $_POST['apellido1'] . "', '" . $_POST['apellido2'] . "', '" . $_POST['extension'] . "', '" . $_POST['email'] . "', '" . $_POST['codigoOficina'] . "', " . $_POST['codigoJefe'] . ", '" . $_POST['puesto'] . "')");
							echo "<h2>Empleado insertado</h2>\n";
							unset($_POST);
							echo "<a href='" . $_SERVER['PHP_SELF'] . "?accion=insertar&ENVIAR=Iniciar+aplicación'>Insertar otro empleado</a>\n";
							echo "<br>\n";
							echo "<a href='" . $_SERVER['PHP_SELF'] . "'>Volver al inicio</a>\n";
						} else {
		?>
							<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
										<label>Código del empleado: </label><input type="number" name="codigoEmpleado" pattern="^(0|[1-9]\d*)$" required>
										<br>
										<label>Nombre: </label><input type="text" name="nombre" pattern="^[A-Za-z\s]{1,50}$" required>
										<br>
										<label>Primer apellido: </label><input type="text" name="apellido1" pattern="^[A-Za-z\s]{1,50}$" required>
										<br>
										<label>Segundo apellido: </label><input type="text" name="apellido2" pattern="^[A-Za-z\s]{1,50}$" required>
										<br>
										<label>Extensión: </label><input type="number" name="extension" pattern="^\d{1,10}$" required>
										<br>
										<label>Dirección de correo electrónico: </label><input type="text" name="email" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" required>
										<br>
										<label>Oficina</label>
										<select name="codigoOficina" required>
											<?php
												$consultaOficinas = mysqli_query($conexion, "SELECT CodigoOficina, CONCAT(Ciudad, ', ', Pais) AS 'Ubicacion' FROM Oficinas");
												while ($oficinas = mysqli_fetch_array($consultaOficinas)) {
													echo "<option value='" . $oficinas['CodigoOficina'] . "'>" . $oficinas['CodigoOficina'] . " - " . $oficinas['Ubicacion'] . "</option>\n";
												}
												mysqli_free_result($consultaOficinas);
											?>
										</select>
										<br>
										<label>Jefe</label>
										<select name="codigoJefe" required>
											<?php
												$consultaJefes = mysqli_query($conexion, "SELECT CodigoEmpleado, CONCAT(Nombre, ' ', Apellido1, ' ', Apellido2) AS 'NombreCompleto' FROM Empleados");
												while ($jefes = mysqli_fetch_array($consultaJefes)) {
													echo "<option value='" . $jefes['CodigoEmpleado'] . "'>" . $jefes['NombreCompleto'] . "</option>\n";
												}
												mysqli_free_result($consultaJefes);
											?>
										</select>
										<br>
										<label>Puesto: </label><input type="text" name="puesto" pattern="^[A-Za-z\s]{1,50}$" required>
										<br>
										<input type="submit" name="INSERTAR" value="Insertar empleado">
										<input type="reset" value="Vaciar campos">
									</form>
		<?php
						}
						break;
					case "modificar":
						if (isset($_POST['NUEVOSDATOS'])) {

						} else {
							if (isset($_GET['MODIFICAR'])) {
								echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='POST'>\n";
									echo "<label>Código del empleado: </label><input type='number' name='codigoEmpleado'>\n";
									echo "<label>Nombre: </label><input type='text' name='nombre' value='" . $empleado['Nombre'] . "'>\n";
									echo "<br>\n";
									echo "<label>Primer apellido: </label><input type='text' name='nombre' value='" . $empleado['Apellido1'] . "'>\n";
									echo "<br>\n";
									echo "<label>Segundo apellido: </label><input type='text' name='apellido1' value='" . $empleado['Apellido2'] . "'>\n";
									echo "<br>\n";
									echo "<label>Extensión: </label><input type='text' name='extension' value='" . $empleado['extension'] . "'>\n";
									echo "<br>\n";
									echo "<label>Dirección de correo electrónico: </label><input type='text' name='extension' value='" . $empleado['email'] . "'>\n";
									echo "<br>\n";
									echo "<label>Código de la oficina: </label>";
									echo "<selection>\n";
									$consultaOficinas = mysqli_query($conexion, "SELECT CodigoOficina, CONCAT(Ciudad, ', ', Pais) AS 'Ubicacion' FROM Oficinas");
									while ($oficinas = mysqli_fetch_array($consultaOficinas)) {
										echo "<option value='" . $oficinas['CodigoOficina'] . "'>" . $oficinas['CodigoOficina'] . " - " . $oficinas['Ubicacion'] . "</option>\n";
									}
									echo "</selection>\n";
									echo "<br>\n";
									echo "<label>Código del jefe: </label>\n";
									$consultaJefes = mysqli_query($conexion, "SELECT CodigoEmpleado, CONCAT(Nombre, ' ', Apellido1, ' ', Apellido2) AS 'NombreCompleto' FROM Empleados");
									while ($jefes = mysqli_fetch_array($consultaJefes)) {
										echo "<option value='" . $jefes['CodigoEmpleado'] . "'>" . $jefes['NombreCompleto'] . "</option>\n";
									}
									echo "<selection>\n";
									mysqli_free_result($consultaJefes);
									mysqli_free_result($consultaOficinas);
								echo "</form>\n";
							} else {
								echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='GET'>\n";
									echo "<label>Código del empleado: </label><input type='number' name='codigoEmpleado'>\n";
									echo "<input type='submit' name='MODIFICAR' value='Modificar empleado'>\n";
								echo "</form>\n";
							}
						}
						break;
					case "eliminar":
						if (isset($_POST['ELIMINAR'])) {
							$consultaEmpleado = mysqli_query($conexion, "SELECT * FROM Empleados WHERE CodigoEmpleado = " . $_POST['codigoEmpleado']);
							$empleado = mysqli_fetch_array($consultaEmpleado);
							$consultaOficina = mysqli_query($conexion, "SELECT CONCAT(Ciudad, ', ', Pais) AS Ubicacion FROM Oficinas WHERE CodigoOficina = '" . $empleado['CodigoOficina'] . "'");
							$oficina = mysqli_fetch_array($consultaOficina);
							$consultaJefe = mysqli_query($conexion, "SELECT CONCAT(Nombre, ' ', Apellido1, ' ', Apellido2) AS NombreCompleto FROM Empleados WHERE CodigoJefe = " . $empleado['CodigoJefe']);
							$jefe = mysqli_fetch_array($consultaJefe);
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
							echo "<a href='" . $_SERVER['PHP_SELF'] . "?accion=eliminar&ENVIAR=Iniciar+aplicación'>Eliminar otro empleado</a>\n";
							echo "<br>\n";
							echo "<a href='" . $_SERVER['PHP_SELF'] . "'>Volver al inicio</a>";
							mysqli_free_result($consultaEmpleado);
							mysqli_free_result($consultaOficina);
							mysqli_free_result($consultaJefe);
							mysqli_query($conexion, "DELETE FROM Empleados WHERE CodigoEmpleado = " . $_POST['codigoEmpleado']);
							echo "<h3>Empleado eliminado</h3>\n";
						} else {
		?>
							<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
								<label>Introduce un código de empleado: </label><input type="number" name="codigoEmpleado" required>
								<input type="submit" name="ELIMINAR" value="Eliminar empleado">
							</form>
		<?php
						}
						break;
					case "consultar":
						if (isset($_POST['CONSULTAR'])) {
							$codigoEmpleado = $_POST['codigoEmpleado'];
							$consultaEmpleado = mysqli_query($conexion, "SELECT * FROM Empleados WHERE CodigoEmpleado = $codigoEmpleado");
							$empleado = mysqli_fetch_array($consultaEmpleado);
							if ((mysqli_num_rows($consultaEmpleado) == 0) AND ($_GET['accion'] != "insertar")) {
								echo "<h1>No existe ese empleado</h1>";
								echo "<a href='" . $_SERVER['PHP_SELF'] . "?accion=consultar&ENVIAR=Iniciar+aplicación'>Volver</a>";
							}
							if ($empleado != NULL) {
								$consultaOficina = mysqli_query($conexion, "SELECT CONCAT(Ciudad, ', ', Pais) AS Ubicacion FROM Oficinas WHERE CodigoOficina = '" . $empleado['CodigoOficina'] . "'");
								$oficina = mysqli_fetch_array($consultaOficina);
								$consultaJefe = mysqli_query($conexion, "SELECT CONCAT(Nombre, ' ', Apellido1, ' ', Apellido2) AS NombreCompleto FROM Empleados WHERE CodigoJefe = " . $empleado['CodigoJefe']);
								$jefe = mysqli_fetch_array($consultaJefe);
							}
							if (mysqli_num_rows($consultaEmpleado) == 1) {
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
								echo "<a href='" . $_SERVER['PHP_SELF'] . "?accion=consultar&ENVIAR=Iniciar+aplicación'>Realizar otra consulta</a>\n";
								echo "<br>\n";
								echo "<a href='" . $_SERVER['PHP_SELF'] . "'>Volver al inicio</a>";
								mysqli_free_result($consultaEmpleado);
								mysqli_free_result($consultaOficina);
								mysqli_free_result($consultaJefe);
							}
						} else {
							echo "<form action='" . $_SERVER['PHP_SELF'] . "?accion=consultar&ENVIAR=Iniciar+aplicación' method='POST'>\n";
								echo "<label>Código del empleado </label><input type='number' name='codigoEmpleado' required>\n";
								echo "<input type='submit' name='CONSULTAR' value='Realizar búsqueda'>\n";
							echo "</form>\n";
						}
						break;
				}
			} else {
		?>
			<h1>Gestión de empleados</h1>
			<h2>Selecciona una opción</h2>
			<form action="<?php $_SERVER['PHP_SELF'] ?>" method="GET">
				<input type="radio" name="accion" value="insertar" required><label>Dar de alta un empleado</label>
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