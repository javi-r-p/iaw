<html>
	<head>
		<title>Ejercicio 1B</title>
		<style>
			table, th, td {
				border: 1px solid black;
				border-collapse: collapse;
				padding: 5px;
			}
		</style>
		<?php
			function tablas ($factor) {
				echo "<table>\n";
				for ($l = 0; $l <=10; $l++) {
					echo "<tr>\n";
					$producto = $factor * $l;
					echo "<td>$factor x $l = </td>\n";
					echo "<td>$producto</td>\n";
					echo "</tr>\n";
				}
				echo "</table>\n";
			}
		?>
	</head>
	<body>
		<?php
			echo "<h2>Tablas de multiplicar 0 a 10 con bucles anidados</h2>\n";
			for ($i = 0; $i <= 10; $i++) {
				echo "<table>\n";
				echo "<tr>\n";
				echo "<th>Tabla del $i</th>\n";
				for ($j = 0; $j <=10; $j++) {
					echo "<tr>\n";
					$k = $i * $j;
					echo "<td>$i x $j = </td>\n";
					echo "<td>$k</td>\n";
					echo "</tr>\n";
				}
				echo "</tr>\n";
				echo "</table>\n";
				echo "<br>\n";
			}

			echo "<h2>Tablas de multiplicar con funciones</h2>\n"; // Ver líneas 12 a 22
			tablas(8);
		?>
	</body>
</html>
