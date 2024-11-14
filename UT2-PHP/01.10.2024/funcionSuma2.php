<html>
	<head>
		<title>Funcion suma 2</title>
		<?php
			// Funcion de suma con variables globales.
			$n = 13;
			function suma ($m) {
				global $n;
				$resultado = $n + $m;
				return $resultado;
			}
		?>
	</head>
	<body>
		<?php
			echo "El resultado de la variable " . $n . " más otra variable es " . suma(12) . ".";
		?>
	</body>
</html>
