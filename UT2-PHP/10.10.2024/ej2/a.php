<html>
	<head>
		<title>Ejercicio 2A</title>
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
			echo "<h2>Recorrer array con el bucle <em>for each</em>; formato lista.</h2>\n";
			echo "<ul>\n";
			foreach ($alumnos as $clave => $valor) {
				echo "<li>" . $clave . ": " . $valor . "</li>\n";
			}
			echo "</ul>\n";
		?>
	</body>
</html>
