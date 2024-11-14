<html>
	<head>
		<title>Bucle contador 1</title>
	</head>
	<body>
		<h1>Contador de 0 a 10 con el bucle <em>while</em>.</h1>
		<?php
			$contador = 0;
			while ($contador <= 10) {
				echo "<li>Elemento $contador</li>\n";
				$contador++;
			}
		?>
	</body>
</html>
