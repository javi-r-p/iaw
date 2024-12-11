<html>
<head>
<title></title>
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
?>
</head>
<body>
<?php
	mysqli_close($conexion);
?>
</body>
</html>