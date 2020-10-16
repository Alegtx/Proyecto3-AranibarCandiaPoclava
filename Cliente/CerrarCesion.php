<html>
	<head>
		<title>Cerrar Sesion</title>
		<link rel="stylesheet" type="text/css" href="../Estilos/Estilo2.css">
	</head>
	<body>
		<center>
			<?php
				session_start();
				session_unset();
				session_destroy();
				echo "<br>"."<br>"."<br>"."<h2>Se cerro la sesion</h2>";
			?>
			<h2><a href="Login.html">Volver al Login</a></h2>
		</center>
	</body>
</html>