<html>
	<head>
		<title>Formulario de consulta BBDD</title>
		<meta charset="UTF-8">
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
			$conexion = mysqli_connect('localhost', 'modf', 'modf', 'jardineria');
		?>
	</head>
	<body>
		<?php
			if (isset($_GET['Buscar'])) {
				$consulta = mysqli_query($conexion, "SELECT * FROM Empleados WHERE Puesto LIKE '%" . $_GET['puesto'] . "%' ORDER BY Puesto");
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
					echo "</tr>\n";
					$i = 0;
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
						echo "</tr>\n";
						$i++;
					}
					echo "</table>\n";
					echo "<p>Se han encontrado " . $i . " empleados</p>\n";
				} else {
					echo "<h1><mark>ERROR:</mark> no existen registros</h1>\n";
				}
			} else {
		?>
			<h1>Búsqueda de empleados por puesto</h1>
			<form action="<?php $_SERVER['PHP_SELF'] ?>" method="GET">
				<label>Puesto que deseas buscar</label>
				<input type="text" name="puesto" placeholder="Introduce aquí un puesto">
				<input type="submit" name="Buscar" value="Buscar empleados">
			</form>
		<?php
			}
		?>
	</body>
</html>