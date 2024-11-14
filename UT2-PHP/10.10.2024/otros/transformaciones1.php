<html>
	<head>
		<title></title>
		<?php

		?>
	</head>
	<body>
		<?php
			echo "Función explode()\n";
			echo "<br>\n";
			$fecha = "2024-10-10";
			$arrayFecha = explode("-",$fecha);
			echo "El mes es " . $arrayFecha[1] . "\n";
			echo "<br>\n";
			echo "<br>\n";
			echo "Función implode()\n";
			echo "<br>\n";
			$fecha2 = array('2024','10','10');
			$cadenaFecha2 = implode("-",$fecha2);
			echo "La fecha es " . $cadenaFecha2 . "\n";
		?>
	</body>
</html>
