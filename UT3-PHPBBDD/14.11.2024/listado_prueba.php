<html>
	<head>
		<title>Prueba de conexión con la base de datos</title>
		<meta charset="UTF-8">
		<?php
			// 1. Conectar con la BBDD
			$conexion = mysqli_connect('localhost', 'modf', 'modf', 'jardineria');
			// 2. Consulta SQL
			$consulta = mysqli_query($conexion, "SELECT * FROM Empleados");
		?>
	</head>
	<body>
		<?php
			// 3. Mostrar resultados
			echo "<ul>\n";
			if (mysqli_num_rows($consulta) > 0) {
				while ($empleados = mysqli_fetch_array($consulta)) {
					echo "<li>Empleado: " . $empleados['Nombre'] . " " . $empleados['Apellido1'] . " " . $empleados['Apellido2'] . "</li>\n";
					echo "<li style='list-style-type: none;'> ----- </li>\n";
				}
			} else {
					echo "<h1>ERROR: TABLA VACÍA</h1>\n";
			}
			echo "</ul>\n";
			mysqli_free_result($consulta);
			mysqli_close($conexion);
		?>
	</body>
</html>