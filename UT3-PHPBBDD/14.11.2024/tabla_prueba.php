<html>
	<head>
		<title>Tabla de empleados de jardineria</title>
		<meta charset='UTF-8'>
		<style>
			table, th, td {
				border: 1px solid black;
				border-collapse: collapse;
			}
			th, td {
				padding: 5px;
			}
		</style>
		<?php
			$conexion = mysqli_connect('localhost', 'consultas', 'consultas', 'jardineria');
			$consulta = mysqli_query($conexion, "SELECT * FROM Empleados");
		?>
	</head>
	<body>
		<?php
			if (mysqli_num_rows($consulta)>0) {
				echo "<h1>Empleados</h1>\n";
				echo "<table>\n";
				echo "<tr>\n";
				echo "<th>Código</th>\n";
				echo "<th>Nombre completo</th>\n";
				echo "<th>Extensión</th>\n";
				echo "<th>Email</th>\n";
				echo "<th>Código de la oficina</th>\n";
				echo "<th>Código de jefe</th>\n";
				echo "<th>Puesto</th>\n";
				echo "</tr>\n";
				while ($empleados = mysqli_fetch_array($consulta)) {
					echo "<tr>\n";
					echo "<td>" . $empleados['CodigoEmpleado'] . "</td>\n";
					echo "<td>" . $empleados['Nombre'] . " " . $empleados['Apellido1'] . " " . $empleados['Apellido2'] . "</td>\n";
					echo "<td>" . $empleados['Extension'] . "</td>\n";
					echo "<td>" . $empleados['Email'] . "</td>\n";
					echo "<td>" . $empleados['CodigoOficina'] . "</td>\n";
					if ($empleados['CodigoJefe'] == NULL) {
						echo "<td>-</td>\n";
					} else {
						echo "<td>" . $empleados['CodigoJefe'] . "</td>\n";
					}
					echo "<td>" . $empleados['Puesto'] . "</td>\n";
					echo "</tr>\n";
				}
				echo "</table>\n";
			} else {
				echo "<h1><mark>ERROR: </mark>no existen registros</h1>\n";
			}
		?>
	</body>
</html>