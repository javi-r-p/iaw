<html>
	<head>
		<title>Conversión de divisas</title>
		<meta charset="UTF-8">
		<?php
			$divisas = array("dolar"=>"1.11", "dolar"=>"0.83", "rublo"=>"118.44", "peso"=>"22.97", "rupia"=>"84.26", "franco"=>"1.02", "dinar"=>"157.78", "libra"=>"15.69");
			function calcularDivisas ($cantidad, $divisa) {
				$valorDivisaStr = $divisas['$divisa'];
				$valorDivisa = floatval($valorDivisaStr);
				$conversion = $valorDivisa*$cantidad;
				return $conversion;
			}
		?>
	</head>
	<body>
		<?php
			echo $_SERVER['PHP_SELF'];
			if (isset($_GET['enviar'])) {
				$euros = floatval($_GET['euros']);
				echo "<h1>RESULTADO DE LA CONVERSIÓN</h1>\n";
				echo $euros . " EUROS = " . calcularDivisas ($euros,$_GET['divisa']); . "\n";
				echo "<br>\n";
				echo "<h1>----- RESTO DIVISAS -----</h1>\n";
				echo "<table>\n";
				echo "<tr>\n";
				echo "<th>DIVISA</th>\n";
				echo "<th>CANTIDAD</th>\n";
				echo "</tr>\n";
				foreach ($divisas as $nombreDivisa => $valor) {
					$funcion = calcularDivisas ($euros, $nombreDivisa);
					echo "<tr>\n";
					echo "<td>" . $nombreDivisa . "</td>\n";
					echo "<td>" . $funcion . "</td>\n";
					echo "</tr>\n";
				}
				echo "</table>\n";
			} else {
				echo '<form method="GET" action="' . $_SERVER['PHP_SELF'] . '">' . "\n";
				echo "<label>CANTIDAD EN EUROS:</label>\n";
				echo '<input type="text" name="euros">' . "\n";
				echo "<br>\n";
				echo '<select name="divisa">' . "\n";
				echo '<option value="dolar">DOLAR' . "\n";
				echo '<option value="libra">LIBRA' . "\n";
				echo '<option value="rublo">RUBLO' . "\n";
				echo '<option value="peso">PESO' . "\n";
				echo '<option value="rupia">RUPIA' . "\n";
				echo '<option value="franco">FRANCO' . "\n";
				echo '<option value="dinar">DINAR' . "\n";
				echo '<option value="lira">LIRA' . "\n";
				echo "</select>\n";
				echo '<input type="submit" name="enviar" value="Convertir">' . "\n";
				echo "</form>\n";
				echo "<p><a href=" . $_SERVER['PHP_SELF'] . ">Volver al formulario</a></p>";
			}
		?>
	</body>
</html>