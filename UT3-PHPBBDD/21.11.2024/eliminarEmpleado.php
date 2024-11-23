<html>
	<head>
		<title>Eliminar empleado por código</title>
		<meta charset="UTF-8">
		<style>
			body {
				font-family: Arial;
			}
		</style>
		<?php
			$conexion = mysqli_connect('localhost', 'modf', 'modf', 'jardineria');
		?>
	</head>
	<body>
		<?php
			mysqli_close($conexion);
			if (isset($_GET['ENVIAR'])) {
				$consultaEmpleado = mysqli_query($conexion, "SELECT * FROM Empleados WHERE CodigoEmpleado = '" . $_GET['codigoEmpleado'] . "'");
				$empleado = mysqli_fetch_array($consultaEmpleado);
				$consultaClientes = mysqli_query($conexion, "");
				$consultaJefes = mysqli_query($conexion, "");
			}
		?>
			<form action="<?php $_SERVER['PHP_SELF'] ?>" method="GET">
				<input type="text" name="codigoEmpleado" placeholder="Introduce un código de empleado">
				<input type="submit" name="ENVIAR">
			</form>
	</body>
</html>