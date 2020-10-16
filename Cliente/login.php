<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../Estilos/Estilo2.css">
		<title></title>
	</head>
	<body >
		<div>
			<center>
				<?php
					$nit=  $_REQUEST["nit"];
					$pass = $_REQUEST["pass"];
					require_once("../conexion.php");
					$conexion = retornarConexion();
					$registros = mysqli_query($conexion,"select * from cliente where NIT = '$nit' and Password='$pass' ")or die("Problemas en el Select...".mysqli_error($conexion));
					if ($reg = mysqli_fetch_array($registros))
					{
						session_start();
						$_SESSION['nit'] = $_REQUEST['nit'];
						$_SESSION['pass'] = $_REQUEST['pass'];
						echo "<h1>Sesion Iniciada</h1>","<br>";
						echo "<h3>Bienvenido </h3>"."<h2>".$reg['Nombre']."</h2>";
						echo "<a href='SuperMercado.php'><h3>Ingresar a nuestro supermercado</h3></a>";
					}
					else
					{
						echo "<h3>Usuario o Password Incorrecta</h3>","<br>";
						echo "<a href='Login.html'><h3>Volver al Login</h3></a>";
					}
					mysqli_close($conexion);
				?>
			</center>
		</div>
	</body>
</html>