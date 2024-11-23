<html>
	<head>
		<title>Dar de alta un empleado</title>
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
		<h2>Dar de alta un empleado</h2>
		<?php
			if (isset($_POST['INSERTAR'])) {
				$codigo = $_POST['codigo'];
				$nombre = $_POST['nombre'];
				$apellido1 = $_POST['apellido1'];
				$apellido2 = $_POST['apellido2'];
				$extension = $_POST['extension'];
				$email = $_POST['email'];
				$oficina = $_POST['oficina'];
				$jefe = $_POST['jefe'];
				$puesto = $_POST['puesto'];
				$consulta = mysqli_query($conexion, "SELECT * FROM Empleados WHERE CodigoEmpleado = $codigo");
				if (mysqli_num_rows($consulta) == 0) {
					mysqli_query($conexion, "INSERT INTO Empleados VALUES ($codigo,'" . $nombre . "','" . $apellido1 . "','" . $apellido2 . "','" . $extension . "','" . $email . "','" . $oficina . "'," . $jefe . ",'" . $puesto . "')");
				} else {
					echo "<h2><mark>ERROR:</mark> Ya existe un empleado con ese código</h2>";
				}
			} else {
		?>
		<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
			<label>Código del empleado</label><input type="number" name="codigo">
			<br>
			<br>
			<label>Nombre</label><input type="text" name="nombre">
			<br>
			<br>
			<label>Primer apellido</label><input type="text" name="apellido1">
			<br>
			<br>
			<label>Segundo apellido</label><input type="text" name="apellido2">
			<br>
			<br>
			<label>Extensión</label><input type="number" name="extension">
			<br>
			<br>
			<label>Correo electrónico</label><input type="text" name="email">
			<br>
			<br>
			<label>Oficina</label><input type="text" name="oficina">
			<br>
			<br>
			<label>Jefe</label><input type="number" name="jefe">
			<br>
			<br>
			<label>Puesto</label><input type="text" name="puesto">
			<br>
			<br>
			<input type="submit" name="INSERTAR" value="Dar de alta">
		</form>
		<?php
			}
			mysqli_close($conexion);
		?>
	</body>
</html>