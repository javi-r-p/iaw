<html>
	<head>
		<title></title>
		<meta charset="UTF-8">
		<style>
			body {
				font-family: Arial;
			}
		</style>
		<?php
			$conexion = mysqli_connect('localhost', 'modf', 'modf', 'jardineria');
			if (isset($_GET['pag'])) {
				$pag = $_GET['pag'];
			} else {
				$pag = 1;
			}
		?>
	</head>
	<body>
		<?php
			$numResultadosPagina = 5;
			$filaInicio = $pag * $numResultadosPagina;
			$numPedidos = mysqli_query($conexion, "SELECT * FROM pedidos");
			$paginasTotales = ceil(mysqli_num_rows($numPedidos) / $numResultadosPagina);
			$pedidos = mysqli_query($conexion, "SELECT * FROM pedidos LIMIT $filaInicio, $numResultadosPagina";
			if (mysqli_num_rows($pedidos) > 0) {
				echo "<table>\n";
				echo "<tr>\n";
				echo "<th>Código del pedido</th>\n";
				echo "<th>Estado</th>\n";
				echo "<th>Fecha</th>\n";
				echo "</tr>\n";
				while ($pedido = mysqli_fetch_array($pedidos)) {
					echo "<tr>\n";
					echo "<td>" . $pedido['CodigoPedido'] . "</td>\n";
					echo "<td>" . $pedido['Estado'] . "</td>\n";
					echo "<td>" . $pedido['FechaPedido'] . "</td>\n";
					echo "</tr>\n";
				}
				for ($i = 1; $i <= $paginasTotales; $i++) {
					echo "<a href='" . $_SERVER['PHP_SELF'] . "?pag=" . $i . "'>Página " . $i . "</a>\n";
				}
			} else {
				echo "<h2>No hay pedidos</h2>\n";
			}
			mysqli_free_result($pedidos);
			mysqli_close($conexion);
		?>
	</body>
</html>