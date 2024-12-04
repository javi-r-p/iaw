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
		?>
	</head>
	<body>
		<?php
			mysqli_close($conexion);
		?>
	</body>
</html>