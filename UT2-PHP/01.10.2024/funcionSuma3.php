<html>
	<head>
		<title>Funcion suma 3</title>
		<?php
			// Funcion de suma con variables superglobales.
			$n = 27;
			function suma ($m) {
				$resultado = $GLOBALS['n'] + $m;
				return $resultado;
			}
		?>
	</head>
	<body>
		<?php
			echo "El resultado de " . $n . " más otra variable es " . suma(27) . ".";
		?>
	</body>
</html>
