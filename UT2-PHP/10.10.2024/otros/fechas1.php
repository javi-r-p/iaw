<html>
	<head>
		<title></title>
		<?php

		?>
	</head>
	<body>
		<?php
			$meses = array(0,"Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
			$diasSemana = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
			$mes = $meses[date("n")];
			$dia = $diasSemana[date("w")];
			echo "$dia " . date("j") . " de $mes " . date(" Y, h:i:s a") . "<br>\n";

			$fechaNac = mktime(0,0,0,8,31,2004);
			$diaNac = $diasSemana[date("w", $fechaNac)];
			echo "Naciste en $diaNac";
		?>
	</body>
</html>
