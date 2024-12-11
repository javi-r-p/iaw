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
		input::-webkit-outer-spin-button, input::-webkit-inner-spin-button {
			-webkit-appearance: none;
			margin: 0;
		}
		input[type=number] {
			-moz-appearance: textfield;
			appearance: textfield;
		}
	</style>
	<?php
		$conexion = mysqli_connect('localhost', 'modf', 'modf', 'jardineria');
		function consultar ($codigoEmpleado) {
			echo "<h2>Consulta de empleado</h2>\n";
			global $conexion;
			$consulta = mysqli_query($conexion, "SELECT * FROM Empleados WHERE CodigoEmpleado = $codigoEmpleado");
			if (mysqli_num_rows($consulta) == 0) {
				echo "<h3>No existe ningún empleado con el identificador " . $codigoEmpleado . "</h3>\n";
				echo "<a href='" . $_SERVER['PHP_SELF'] . "?accion=consultar&inicio=Iniciar'>Ejecutar otra consulta</a>\n";
			} else {
				$empleado = mysqli_fetch_array($consulta);
				echo "<table>\n";
				echo "<tr>\n";
				echo "<th>Código del empleado</th>\n";
				echo "<th>Nombre completo</th>\n";
				echo "<th>Extensión</th>\n";
				echo "<th>Correo electrónico</th>\n";
				echo "<th>Código de la oficina</th>\n";
				echo "<th>Código de jefe</th>\n";
				echo "<th>Puesto</th>\n";
				echo "</tr>\n";
				echo "<tr>\n";
				echo "<td>" . $empleado['CodigoEmpleado'] . "</td>\n";
				echo "<td>" . $empleado['Nombre'] . " " . $empleado['Apellido1'] . " " . $empleado['Apellido2'] . "</td>\n";
				echo "<td>" . $empleado['Extension'] . "</td>\n";
				echo "<td>" . $empleado['Email'] . "</td>\n";
				echo "<td>" . $empleado['CodigoOficina'] . "</td>\n";
				if ($empleado['CodigoJefe'] == NULL) {
					echo "<td> - </td>\n";
				} else {
					echo "<td>" . $empleado['CodigoJefe'] . "</td>\n";
				}
				echo "<td>" . $empleado['Puesto'] . "</td>\n";
				echo "</tr>\n";
				echo "</table>\n";
				echo "<hr>\n";
				echo "<a href='" . $_SERVER['PHP_SELF'] . "?accion=consultar&inicio=Iniciar'>Consultar otro empleado</a>\n";
				echo "<br>\n";
				echo "<a href='" . $_SERVER['PHP_SELF'] . "'>Volver al inicio</a>\n";
			}
			mysqli_free_result($consulta);
		}
		function insertar () {
			global $conexion;
			echo "<h2>Creación de un empleado\n</h2>";
			echo "<form action='" . $_SERVER['PHP_SELF'] . "?accion=insertar&inicio=Iniciar" . "' method='POST'>\n";
			if (isset($_POST['insertarEmpleado'])) {
				$nombre = $_POST['nombre'];
				$nombreCompleto = explode (" ", $nombre);
				mysqli_query ($conexion, "INSERT INTO Empleados VALUES (" . $_POST['codigoEmpleado'] . ", '" . $nombreCompleto[0] . "', '" . $nombreCompleto[1] . "', '" . $nombreCompleto[2] . "', '" . $_POST['extension'] . "', '" . $_POST['email'] . "', '" . $_POST['oficina'] . "', " . $_POST['jefe'] . ", '" . $_POST['puesto'] . "')");
				echo "<h3>Empleado insertado</h3>\n";
				echo "<a href='" . $_SERVER['PHP_SELF'] . "?verDatos=si&codigoEmpleado=" . $_POST['codigoEmpleado'] . "'>Ver los datos del empleado " . $_POST['codigoEmpleado'] . "</a>\n";
				echo "<hr>\n";
				echo "<a href='" . $_SERVER['PHP_SELF'] . "?accion=insertar&inicio=Iniciar'>Insertar otro empleado</a>\n";
				echo "<br>\n";
				echo "<a href='" . $_SERVER['PHP_SELF'] . "'>Volver al inicio</a>\n";
			} else {
				$codigoEmpleado = mysqli_query($conexion, "SELECT CodigoEmpleado FROM Empleados ORDER BY CodigoEmpleado DESC LIMIT 1");
				$ultimoCodigoEmpleado = mysqli_fetch_array($codigoEmpleado);
				$ultimoCodigoEmpleado = $ultimoCodigoEmpleado['CodigoEmpleado'] + 1;
				echo "<label>Identificador: </label>\n<input type='number' name='codigoEmpleado' value='" . $ultimoCodigoEmpleado . "' readonly>\n<br>\n";
				mysqli_free_result($codigoEmpleado);
				echo "<label>Nombre completo: </label>\n<input type='text' name='nombre' required>\n<br>\n";
				echo "<label>Extensión: </label>\n<input type='text' name='extension' required>\n<br>\n";
				echo "<label>Correo electrónico: </label>\n<input type='text' name='email' required><br>\n";
				echo "<label>Oficina: </label>\n<select name='oficina' required>\n<br>\n";
				$oficinas = mysqli_query($conexion, "SELECT CodigoOficina, CONCAT(Ciudad, ' ', Pais) AS Ubicacion FROM Oficinas");
				while ($oficina = mysqli_fetch_array($oficinas)) {
					echo "<option value='" . $oficina['CodigoOficina'] . "'>" . $oficina['CodigoOficina'] . " - " . $oficina['Ubicacion'] . "</option>\n";
				}
				mysqli_free_result($oficinas);
				echo "</select>\n<br>\n";
				echo "<label>Supervisor: </label>\n<select name='jefe' required><br>\n";
				$supervisores = mysqli_query($conexion, "SELECT CodigoJefe, CONCAT(Nombre, ' ', Apellido1, ' ', Apellido2) AS NombreCompleto FROM Empleados");
				while ($supervisor = mysqli_fetch_array($supervisores)) {
					echo "<option value='" . $supervisor['CodigoJefe'] ."'>" . $supervisor['NombreCompleto'] . "</option>\n";
				}
				mysqli_free_result($supervisores);
				echo "</select>\n<br>\n";
				echo "<label>Puesto: </label>\n<input type='text' name='puesto'>\n<br>\n";
				echo "<input type='submit' name='insertarEmpleado' value='Insertar'>\n";
				echo "<input type='reset' value='Borrar campos'>\n";
				echo "</form>\n";
			}
		}
		function modificar ($codigoEmpleado) {
			global $conexion;
			$consulta = mysqli_query($conexion, "SELECT * FROM Empleados WHERE CodigoEmpleado = $codigoEmpleado");
			if (mysqli_num_rows($consulta) == 0) {
				echo "<h2>No existe el empleado con código " .$codigoEmpleado . ".</h2>\n";
			} else {
				if (isset($_POST['modificarEmpleado'])) {
					$nombre = $_POST['nombre'];
					$nombreCompleto = explode (" ", $nombre);
					mysqli_query ($conexion, "UPDATE Empleados SET Nombre = '" . $nombreCompleto[0] . "', Apellido1 = '" . $nombreCompleto[1] . "', Apellido2 = '" . $nombreCompleto[2] . "', Extension = '" . $_POST['extension'] . "', Email = '" . $_POST['email'] . "', CodigoJefe = " . $_POST['jefe'] . ", CodigoOficina = '" . $_POST['oficina'] . "', Puesto = '" . $_POST['puesto'] . "' WHERE CodigoEmpleado = $codigoEmpleado");
					echo "<h3>Empleado modificado</h3>\n";
					echo "<a href='" . $_SERVER['PHP_SELF'] . "?verDatos=si&codigoEmpleado=" . $_POST['codigoEmpleado'] . "'>Ver los datos del empleado " . $_POST['codigoEmpleado'] . "</a>\n";
					echo "<hr>\n";
					echo "<a href='" . $_SERVER['PHP_SELF'] . "?accion=modificar&inicio=Iniciar'>Modificar otro empleado</a>\n";
					echo "<br>\n";
					echo "<a href='" . $_SERVER['PHP_SELF'] . "'>Volver al inicio</a>\n";
				} else {
					$empleado = mysqli_fetch_Array($consulta);
					echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='POST'>\n";
					echo "<label>Identificador: </label>\n<input type='number' name='codigoEmpleado' value='" . $codigoEmpleado . "' readonly>\n<br>\n";
					$nombreCompleto = $empleado['Nombre'] . " " . $empleado['Apellido1'] . " " . $empleado['Apellido2'];
					echo "<label>Nombre completo: </label>\n<input type='text' name='nombre' value='" . $nombreCompleto . "'>\n<br>\n";
					echo "<label>Extensión: </label>\n<input type='text' name='nombre' value='" . $empleado['Extension'] . "'>\n<br>\n";
					echo "<label>Correo electrónico: </label>\n<input type='text' name='email' value='" . $empleado['Email'] . "'>\n<br>\n";
					echo "<label>Oficina: </label>\n<select name='oficina' required>\n<br>\n";
					$oficinas = mysqli_query($conexion, "SELECT CodigoOficina, CONCAT(Ciudad, ' ', Pais) AS Ubicacion FROM Oficinas");
					while ($oficina = mysqli_fetch_array($oficinas)) {
						if ($oficina['CodigoOficina'] == $empleado['CodigoOficina']) {
							echo "<option value='" . $oficina['CodigoOficina'] . "' selected>" . $oficina['CodigoOficina'] . " - " . $oficina['Ubicacion'] . "</option>\n";
						} else {
							echo "<option value='" . $oficina['CodigoOficina'] . "'>" . $oficina['CodigoOficina'] . " - " . $oficina['Ubicacion'] . "</option>\n";
						}
					}
					mysqli_free_result($oficinas);
					echo "</select>\n<br>\n";
					echo "<label>Supervisor: </label>\n<select name='jefe' required><br>\n";
					$supervisores = mysqli_query($conexion, "SELECT CodigoJefe, CONCAT(Nombre, ' ', Apellido1, ' ', Apellido2) AS NombreCompleto FROM Empleados");
					while ($supervisor = mysqli_fetch_array($supervisores)) {
						if ($supervisor['CodigoEmpleado'] == $empleado['CodigoJefe']) {
							echo "<option value='" . $supervisor['CodigoJefe'] ."' selected>" . $supervisor['NombreCompleto'] . "</option>\n";
						} else {
							echo "<option value='" . $supervisor['CodigoJefe'] ."'>" . $supervisor['NombreCompleto'] . "</option>\n";
						}
					}
					mysqli_free_result($supervisores);
					echo "<label>Puesto: </label>\n<input type='text' name='puesto' value='" . $empleado['Puesto'] . "'>\n<br>\n";
					echo "<input type='submit' name='modificarEmpleado' value='Modificar'>\n";
					echo "<input type='reset' value='Borrar campos'>\n";
					echo "</select>\n<br>\n";
					echo "</form>\n";
					echo "<hr>\n";
					echo "<a href='" . $_SERVER['PHP_SELF'] . "'>Volver al inicio</a>\n";
				}
			}
		}
	?>
</head>
<body>
	<h1>Gestión de empleados</h1>
	<hr>
	<?php
		if (isset($_GET['inicio'])) {
			$accion = $_GET['accion'];
			switch ($accion) {
				case "consultar":
					if (isset($_POST['ejecutarConsulta'])) {
						consultar ($_POST['codigoEmpleado']);
					} else {
						echo "<form action='" . $_SERVER['PHP_SELF'] . "?accion=consultar&inicio=Iniciar' method='POST'>\n";
						echo "<label>Código del empleado: </label><input type='number' name='codigoEmpleado' required>\n";
						echo "<input type='submit' name='ejecutarConsulta' value='Consultar'>\n";
						echo "</form>\n";
					}
					break;
				case "insertar":
					insertar();
					break;
				case "modificar":
					if (isset($_POST['buscarEmpleado'])) {
						modificar ($_POST['codigoEmpleado']);
					} else {
						echo "<form action='" . $_SERVER['PHP_SELF'] . "?accion=modificar&inicio=Iniciar' method='POST'>\n";
						echo "<label>Código del empleado: </label><input type='number' name='codigoEmpleado' required>\n";
						echo "<input type='submit' name='buscarEmpleado' value='Consultar'>\n";
						echo "</form>\n";
					}
					break;
				/* case "eliminar":
					break; */
				default:
					echo "<h2>La opción que has seleccionado aún no está disponible.</h2>\n";
					echo "<a href='" . $_SERVER['PHP_SELF'] . "'>Volver al inicio</a>\n";
					break;
			}
		} else {
	?>
		<form action="<?php $_SERVER['PHP_SELF'] ?>" method="GET">
			<input type="radio" name="accion" value="consultar" required><label>Consultar</label><br>
			<input type="radio" name="accion" value="insertar"><label>Insertar</label><br>
			<input type="radio" name="accion" value="modificar"><label>Modificar</label><br>
			<input type="radio" name="accion" value="eliminar"><label>Eliminar</label><br>
			<input type="submit" name="inicio" value="Iniciar">
		</form>
	<?php
		}
		if (isset($_GET['verDatos'])) {
			consultar($_GET['codigoEmpleado']);
		}
		mysqli_close($conexion);
	?>
</body>
</html>