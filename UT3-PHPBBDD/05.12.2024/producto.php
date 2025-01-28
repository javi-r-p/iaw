<html>
<head>
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
	if (isset($_GET['codigoProducto'])) {
		$codigoProducto = $_GET['codigoProducto'];
	} else {
		$codigoProducto = 0;
	}
	echo "<title>Producto " . $codigoProducto . "</title>\n";
?>
</head>
<body>
<?php
	if ($codigoProducto == 0) {
		echo "<h2>Debes introducir un término de búsqueda.</h2>\n";
	} else {
		$consulta = mysqli_query($conexion, "SELECT * FROM Productos WHERE CodigoProducto = '$codigoProducto'");
		$producto = mysqli_fetch_array($consulta);
		echo "<table>\n";
		echo "<tr>\n";
		echo "<th>Código del producto</th>\n";
		echo "<th>Nombre</th>\n";
		echo "<th>Gama</th>\n";
		echo "<th>Dimensiones</th>\n";
		echo "<th>Proveedor</th>\n";
		echo "<th>Descripción</th>\n";
		echo "<th>Cantidad en stock</th>\n";
		echo "<th>P.V.P</th>\n";
		echo "<th>Precio fábrica</th>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo "<td>" . $producto['CodigoProducto'] . "</td>\n";
		echo "<td>" . $producto['Nombre'] . "</td>\n";
		echo "<td>" . $producto['Gama'] . "</td>\n";
		echo "<td>" . $producto['Dimensiones'] . "</td>\n";
		echo "<td>" . $producto['Proveedor'] . "</td>\n";
		echo "<td>" . $producto['Descripcion'] . "</td>\n";
		echo "<td>" . $producto['CantidadEnStock'] . "</td>\n";
		echo "<td>" . $producto['PrecioVenta'] . "</td>\n";
		echo "<td>" . $producto['PrecioProveedor'] . "</td>\n";
		echo "</tr>\n";
		echo "</table>\n";
		echo "<hr>\n";
		echo "<a href='paginacion.php'>Volver</a>\n";
	}
	mysqli_close($conexion);
?>
</body>
</html>