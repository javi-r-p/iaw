<html>
	<head>
		<title>Funcion de suma 1</title>
		<?php
			// Funcion de suma con variables locales.
			function suma ($n, $m) {
				$resultado = $n + $m;
				return $resultado;
			}
		?>
	</head>
	<body>
		<?php
			echo "El resultado de la suma de dos variables locales es igual a " . suma(5,5);
		?>
	</body>
</html>
