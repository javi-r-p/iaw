<html>
	<head>
		<title>Ejercicio 1A</title>
		<?php
			function tablas ($factor) {
				echo "<ul>";
				for ($l = 0; $l <=10; $l++) {
					$producto = $factor * $l;
					echo "<li>$factor x $l = $producto</li>";
				}
				echo "</ul>";
			}
		?>
	</head>
	<body>
		<?php
			echo "<h2>Tablas de multiplicar 0 a 10 con bucles anidados</h2>";
			for ($i = 0; $i <= 10; $i++) {
				echo "<p>Tabla de multiplicar del $i</p>";
				echo "<ul>";
				for ($j = 0; $j <=10; $j++) {
					$k = $i * $j;
					echo "<li>$i x $j = $k";
				}
				echo "</ul>";
			}

			echo "<h2>Tablas de multiplicar con funciones</h2>"; // Ver líneas 5 a 10
			tablas(5);
		?>
	</body>
</html>
