<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" type="text/css" href="../Estilos/estilo.css">
		<title>Cambiar Password</title>
	</head>
	<body>
		<center>
			<?php
				session_start();
				$user = $_REQUEST['cod'];
				$pass =  $_REQUEST["pass"];
				$confpass =  $_REQUEST["newpass"];
				$Captcha = $_REQUEST['numero'];
				if ($_SESSION['numeroaleatorio'] == $Captcha)
				{
					if($pass == $confpass)
					{
						require_once("../conexion.php");
						$conexion=retornarConexion();
						$registros = mysqli_query($conexion,"select * from personas as P inner join login as L on P.CI=L.ci and L.ci = '$user' ")or die("Problemas en el Select...".mysqli_error($conexion));
						if ($reg = mysqli_fetch_array($registros))
						{
							mysqli_query($conexion, "update login set Pass='$pass' where ci='$user'") or die("Problemas en el select:".mysqli_error($conexion));
							echo "La contraseña fue Modificada";
						}
						else
						{
							echo "Usuario Incorrecto";
						}
					}
					else
					{
						echo "Las contraseñas no coinciden";
					}
				}
				else
				{
					echo "<h2>Captcha incorrecto</h2>","<br>";
				}
			?>
		<a href="../Inicio.html"><h2>Volver al Login</h2></a>
		</center>
	</body>
</html>