<html>
	<head>
		<title>Ejercicio 2B</title>
		<style>
			table, th, td {
				border: 1px solid black;
				border-collapse: collapse;
				padding: 5px;
			}
		</style>
	</head>
	<body>
		<?php
			$alumnos = array("Delegado" => "Juan","Subdelegado" => "Antonio","Secretaria" => "María","Vocal1" => "Pedro","Vocal2" => "Jaime");
			echo "<h2>Recorrer array con el bucle <em>for</em> y la función <em>list()</em>.</h2>\n";
			echo "<table>\n";
			echo "<tr>\n";
			echo "<th>Cargo</th>\n";
			echo "<th>Alumno</th>\n";
			echo "</tr>\n";
			for ($i = 0; $i < count($alumnos); $i++) {
				list($cargo,$alumno) = array(Key($alumnos), current($alumnos));
				echo "<tr>\n";
				echo "<td>" . $cargo . "</td>\n";
				echo "<td>" . $alumno . "</td>\n";
				echo "</tr>\n";
				next($alumnos);
			}
			echo "</table>\n";
		?>
	</body>
</html>
