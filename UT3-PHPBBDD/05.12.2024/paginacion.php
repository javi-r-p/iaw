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
	//Conexión a la base de datos y declaración de la variable que contiene el número de página
	$conexion = mysqli_connect('localhost', 'modf', 'modf', 'jardineria');
	if (isset($_GET['pag'])) {
		$pag = $_GET['pag'];
	} else {
		$pag = 0;
	}
	//Número de resultados a mostrar por página
	$numFilasPag = 1;
?>
</head>
<body>
<?php
	//La primera fila que se coge de la consulta es el resultado de multiplicar el número de la página que se
	//está visualizando por el número de resultados a mostrar por página, por lo que si el número de página
	//es 3 y el número de filas por página es 1, se cogerá la fila número 3 de las que se obtengan en la consulta
	$filaIni = $pag * $numFilasPag;

	//Consulta de los pedidos con LIMIT
	$pedidos = mysqli_query ($conexion, "SELECT * FROM Pedidos LIMIT $filaIni, $numFilasPag");

	//Si el número de pedidos encontrados es mayor que 0, mostrar una tabla con información del pedido
	//y sus productos
	if (mysqli_num_rows($pedidos) > 0) {
		//Tabla
		echo "<table>\n";
		echo "<caption>Datos del pedido</caption>\n";
		echo "<tr>\n";
		echo "<th>Código del pedido</th>\n";
		echo "<th>Fecha</th>\n";
		echo "<th>Estado</th>\n";
		echo "</tr>\n";

		//Datos del pedido
		while ($pedido = mysqli_fetch_array($pedidos)) {
			$codigoPedido = $pedido['CodigoPedido'];
			echo "<tr>\n";
			echo "<td>" . $pedido['CodigoPedido'] . "</td>\n";
			echo "<td>" . $pedido['FechaPedido'] . "</td>\n";
			echo "<td>" . $pedido['Estado'] . "</td>\n";
			echo "</tr>\n";
		}
		echo "</table>\n";
		echo "<hr>\n";

		//Enlace para ir a la página anterior
		if ($pag > 0) {
			$pagAnt = $pag -1;
			echo "<a href='" . $_SERVER['PHP_SELF'] . "?pag=" . $pagAnt . "'>Pedido anterior</a>\n";
		}

		//Consultar el número de pedidos, esta consulta se necesita para obtener el número
		//total de páginas
		$numPedidos = mysqli_query($conexion, "SELECT COUNT(*) FROM Pedidos");
		list($numFilasTotal) = mysqli_fetch_array($numPedidos);
		$pagTotal = ceil($numFilasTotal / $numFilasPag);

		//Enlace para ir a la siguiente página
		if ($pag < ($pagTotal -1)) {
			$pagSig = $pag +1;
			echo "<a href='" . $_SERVER['PHP_SELF'] . "?pag=" . $pagSig . "'>Siguiente pedido</a>\n";
		}
		echo "<hr>\n";

		//Consultar los detalles del pedido
		$productos = mysqli_query ($conexion, "SELECT Productos.CodigoProducto, Cantidad, PrecioUnidad, Nombre, Gama FROM DetallePedidos INNER JOIN Productos ON DetallePedidos .CodigoProducto = Productos.CodigoProducto WHERE CodigoPedido = $codigoPedido");

		//Tabla
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

		//La variable total es a la que se le irán sumando todos los subtotales, si no
		//se establece en 0, se mostrará un error diciendo que no se ha definido la variable
		$total = 0;

		//Mostrar todos los productos del pedido con su cantidad, precio por unidad y subtotal
		while ($producto = mysqli_fetch_array($productos)) {
			echo "<tr>\n";
			echo "<td>" . $producto['CodigoProducto'] . "</td>\n";
			echo "<td>" . $producto['Nombre'] . "</td>\n";
			echo "<td>" . $producto['Gama'] . "</td>\n";
			echo "<td>" . $producto['Cantidad'] . "</td>\n";
			echo "<td>" . $producto['PrecioUnidad'] . "€</td>\n";
			echo "<td>" . $producto['Cantidad'] * $producto['PrecioUnidad'] . "€</td>\n";
			echo "</tr>\n";
			$total += $producto['Cantidad'] * $producto['PrecioUnidad'];
		}
		echo "</table>\n";

		//Mostrar el importe total del pedido
		echo "<h2>Total: " . $total . "€</h2>\n";
		echo "<hr>\n";

		//Librerar los resultados del número de pedidos y los detalles del pedido
		mysqli_free_result($numPedidos);
		mysqli_free_result($productos);
	} else {

		//Si no se encuentran pedidos, se muestra este mensaje
		echo "<h2>No existen pedidos</h2>\n";
	}

	//Liberar los resultados del pedido
	mysqli_free_result($pedidos);

	//Cerrar la conexión con la base de datos
	mysqli_close($conexion);
?>
</body>
</html>