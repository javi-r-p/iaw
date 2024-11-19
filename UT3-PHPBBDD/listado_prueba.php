<html>
	<head>
		<title>Prueba de conexión con la base de datos</title>
		<meta charset="UTF-8">
		<?php
			// 1. Conectar con la BBDD
			$conexion = mysqli_connect('localhost', 'consultas', 'consultas', 'jardineria');
			// 2. Consulta SQL
			$consulta = mysqli_query($conexion, "SELECT * FROM Empleados");
		?>
	</head>
	<body>
		<?php
			// 3. Mostrar resultados
			if (mysqli_num_rows($consulta) > 0) {
				while ($empleados = mysqli_fetch_array($consulta)) {
					echo "Nombre completo del empleado: " . $empleados['Nombre'] . " " . $empleados['Apellido1'] . " " . $empleados['Apellido2'] . "<br>\n";
				}
			} else {
					echo "<h1>ERROR: TABLA VACÍA</h1>\n";
			}
			mysqli_free_result($consulta);
			mysqli_close($conexion);
		?>
	</body>
</html>