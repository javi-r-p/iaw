<html>
<head>
<title>Paginación</title>
<meta charset="UTF-8">
<style>
	body {
		font-family: Arial;
	}
	table, th, td {
		border: 1px solid black;
		border-collapse: collapse;
	}
	th, td {
		padding: 10px;
	}
</style>
<?php
	$conexion = mysqli_connect('localhost', 'modf', 'modf', 'jardineria');
	if (isset($_GET['pag'])) {
		$pag = $_GET['pag'];
	} else {
		$pag = 1;
	}
	$numFilasPag = 1;
?>
</head>
<body>
<?php
	$filaIni = $pag * $numFilasPag;
	$pedidos = mysqli_query ($conexion, "SELECT * FROM Pedidos LIMIT $filaIni, $numFilasPag");
	if (mysqli_num_rows($pedidos) > 0) {
		while ($pedido = mysqli_fetch_array($pedidos)) {
			$codigoPedido = $pedido['CodigoPedido'];
			echo "<table>\n";
			echo "<caption>Datos del pedido</caption>\n";
			echo "<tr>\n";
			echo "<th>Código del pedido</th>\n";
			echo "<th>Fecha</th>\n";
			echo "<th>Estado</th>\n";
			echo "</tr>\n";
			echo "<tr>\n";
			echo "<td>" . $pedido['CodigoPedido'] . "</td>\n";
			echo "<td>" . $pedido['FechaPedido'] . "</td>\n";
			echo "<td>" . $pedido['Estado'] . "</td>\n";
			echo "</tr>\n";
			echo "</table>\n";
		}

		if ($pag > 1) {
			$pagAnt = $pag -1;
			echo "<a href='" . $_SERVER['PHP_SELF'] . "?pag=" . $pagAnt . "'>Pedido anterior</a>\n";
		}

		$numPedidos = mysqli_query($conexion, "SELECT COUNT(*) FROM Pedidos");
		list($numFilasTotal) = mysqli_fetch_array($numPedidos);
		$pagTotal = ceil($numFilasTotal / $numFilasPag);

		if ($pag < ($pagTotal -1)) {
			$pagSig = $pag +1;
			echo "<a href='" . $_SERVER['PHP_SELF'] . "?pag=" . $pagSig . "'>Siguiente pedido</a>\n";
		}

		$productos = mysqli_query ($conexion, "SELECT Productos.CodigoProducto, Cantidad, PrecioUnidad, Nombre, Gama FROM DetallePedidos INNER JOIN Productos ON DetallePedidos .CodigoProducto = Productos.CodigoProducto WHERE CodigoPedido = $codigoPedido");

		echo "<table>\n";
		echo "<caption>Productos</caption>\n";
		echo "<tr>\n";
		echo "<th>Código del producto</th>\n";
		echo "<th>Nombre</th>\n";
		echo "<th>Gama</th>\n";
		echo "<th>Cantidad</th>\n";
		echo "<th>Precio por unidad</th>\n";
		echo "<th>Subtotal</th>\n";
		echo "</tr>\n";
		while ($producto = mysqli_fetch_array($productos)) {
			echo "<tr>\n";
			echo "<td>" . $producto['CodigoProducto'] . "</td>\n";
			echo "<td>" . $producto['Nombre'] . "</td>\n";
			echo "<td>" . $producto['Gama'] . "</td>\n";
			echo "<td>" . $producto['Cantidad'] . "</td>\n";
			echo "<td>" . $producto['PrecioUnidad'] . "</td>\n";
			echo "<td>" . $producto['Cantidad'] * $producto['PrecioUnidad'] . "€</td>\n";
			echo "</tr>\n";
			$total += $producto['Cantidad'] * $producto['PrecioUnidad'];
		}
		echo "</table>\n";
		echo "<h2>Total: " . $total . "€</h2>\n";
		mysqli_free_result($numPedidos);
		mysqli_free_result($productos);
	} else {
		echo "<h2>No existen pedidos</h2>\n";
	}
	mysqli_free_result($pedidos);
	mysqli_close($conexion);
?>
</body>
</html>