<html>
	<head>
		<title>Ejercicio 1 hoja 3</title>
		<meta charset="UTF-8">
	</head>
	<body>
		<?php
			echo "<ul>\n";
			foreach ($_POST as $campo => $valor) {
				echo "<li>";
				echo $campo . ":" . $valor;
				echo "</li>\n";
			}
			echo "</ul>\n"
		?>
	</body>
</html>
