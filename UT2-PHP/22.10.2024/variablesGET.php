<html>
	<head>
		<meta charset="UTF-8">
		<title>Variables GET</title>
	</head>
	<body>
		<?php
			// Comprobación de la variable ID
			if (isset($_GET['id'])) {
				if (empty($_GET['id'])) {
					echo "Error: ID vacío\n";
				}
				else {
					echo "Variable ID con valor: " . $_GET['id'] . "<br>\n";
				}
			}
			else {
				echo "Error: no se ha enviado un ID válido.\n";
			}
			// Comprobación de la variable Usuario
			if (isset($_GET['usuario'])) {
				if (empty($_GET['usuario'])) {
					echo "Error: usuario vacío\n";
				}
				else {
					echo "Variable usuario con valor: " . $_GET['usuario'] . "<br>\n";
				}
			}
			else {
				echo "Error: no se ha enviado un usuario válido.\n";
			}
		?>
	</body>
</html>
