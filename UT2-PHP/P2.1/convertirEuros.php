<html>
	<head>
		<title>Conversión de divisas</title>
		<meta charset="UTF-8">
		<?php
			$divisas = array("dolar"=>1.11, "libra"=>0.83, "rublo"=>118.44, "peso"=>22.97, "rupia"=>84.26, "franco"=>1.02, "dinar"=>157.78, 
			"lira"=>15.69);
			function conversion($cantidad, $mon) {
				global $divisas;
				global $divisa;
				if (array_key_exists($divisa, $divisas)) {
					$dinero = $cantidad * $divisas[$mon];
				} else {
					$dinero = "No hay datos de esa moneda.";
				}
				return $dinero;
			}
		?>
	</head>
	<body>
		<?php
			$eurosVacio = false;
			if (isset($_GET['enviar'])) {
				if (empty($_GET['euros'])) {
					$eurosVacio = true;
				}
				$euros = $_GET['euros'];
				$euros = floatval($euros);
				$divisa = $_GET['divisa'];
				echo "<h1>RESULTADO DE LA CONVERSIÓN</h1>\n";
				$resultado = conversion($euros, $divisa);
				echo "$euros EUROS = $resultado $divisa.\n";
				unset($resultado);
				echo "<br>";
				echo "<h1> ----- RESTO DE DIVISAS -----</h1>\n";
				echo "<table border='1'>\n";
				foreach ($divisas as $moneda => $valor) {
					if ($moneda != $divisa) {
						$resultado = conversion($euros, $moneda);
						echo "<tr><td>$resultado</td><td>$moneda</td></tr>\n";
					}
				}
				echo "</table>\n";
				echo "<p><a href=" . $_SERVER['PHP_SELF'] . ">Volver al formulario</a></p>";
			}
			if (empty($_GET['euros']) or ($eurosVacio)) {
				echo '<form method="GET" action="' . $_SERVER['PHP_SELF'] . '">' . "\n";
				echo "<label>CANTIDAD EN EUROS:</label>\n";
				echo '<input type="text" name="euros">' . "\n";
				if ($eurosVacio) {
					echo "<span style='color: red;'>ERROR</span>: el nombre está vacío";
					unset($_GET);
				}
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
			}
		?>
	</body>
</html>