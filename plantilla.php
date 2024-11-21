<html>
	<head>
		<title></title>
		<meta charset="UTF-8">
		<?php
			$conexion = mysqli_connect('localhost', 'consultas', 'consultas', 'jardineria');
		?>
	</head>
	<body>
		<?php
			mysqli_close($conexion);
		?>
	</body>
</html>