<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="Estilos/estilo.css">
		<title></title>
	</head>
	<body>
		<div>
			<center>
				<?php
					$ci=  $_REQUEST["ci"];
					$pass=$_REQUEST["pass"];
					require_once("conexion.php");
					$conexion=retornarConexion();
					$registros = mysqli_query($conexion,"select * from personas as P inner join Login as L on P.CI=L.ci and L.ci = '$ci' and L.Pass='$pass' ")or die("Problemas en el Select...".mysqli_error($conexion));
					if ($reg = mysqli_fetch_array($registros))
					{
						session_start();
						$_SESSION['usuario']=$_REQUEST['ci'];
						$_SESSION['clave']=$_REQUEST['pass'];
						echo "<h2>Sesion Iniciada</h2>","<br>";
						echo "<h2>Bienvenido </h2>"."<h3>".$reg['Nombre']."</h3>";
						echo "<a href='Menu.php'><h1>Ingresar</h1></a>";
					}
					else
					{
							echo "<h2>Usuario o Password Incorrecta</h2>","<br>";
							echo "<a href='Inicio.html'><h2>Volver al Login</h2></a>";
					}
					mysqli_close($conexion);
				?>
			</center>
		</div>
	</body>
</html>