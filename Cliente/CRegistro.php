<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" type="text/css" href="../Estilos/estilo.css">
		<title>Registro de Personas</title>
	</head>
	<body>
		<center>
			<?php
				session_start();
				$Captcha=$_REQUEST["numero"];
				if ($_SESSION['numeroaleatorio'] == $Captcha)
				{
					$nit =  $_REQUEST["nit"];
					$nombre =  $_REQUEST["Nombre"];
					$paterno =  $_REQUEST["ApPa"];
					$materno =  $_REQUEST["ApMa"];
					$celular =  $_REQUEST["Cel"];
					$CodCarrito=rand(1000,9000000);
					$pass = $_REQUEST["pass"];
					$fecha = date("Y-m-d H:i:s");
					$CodCarrito="CP".$CodCarrito;
					require_once("../conexion.php");
					$conexion = retornarConexion();
					mysqli_query($conexion,"insert into cliente(NIT,Nombre,ApellidoPaterno,ApellidoMaterno,Celular,Password,FRegistro) values ('$nit','$nombre','$paterno','$materno','$celular','$pass','$fecha')") or die("Problemas en el select".mysqli_error($conexion));
					mysqli_query($conexion,"insert into pedidos(CodCarrito,fechaPedido,CodCliente,NombresProductos,CantidadProductos,Pago,EstadoPedido) values ('$CodCarrito','$fecha','$nit','','','0','INACTIVO')") or die("Problemas en el select".mysqli_error($conexion));
					mysqli_close($conexion);
					echo "<h1>Guardado correctamente!</h1>","<br>","<br>";
					echo "<h2>Su Codigo de Usuario es:",$nit,"</h2><br>";
					echo "<h2>Su Password es:",$pass,"</h2><br>";
					echo "<h3>Desde este momento usted tiene su Carrito de compra para acceder a nuestros servicios</h3>","<br>";
					echo "<h3>Recuerda siempre cancelar la compra con el carrito, caso contrario no podras acceder a nuestros servicios</h3>","<br>";
					echo "<a href='Login.html'><h2>Volver al Login</h2></a>";
				}
				else
				{
					echo "<h3>Captcha Incorrecto!</h3>","<br>";
					echo "<a href='CRegistro.html'><h2>Volver al Registro</h2></a>";
				}
			?>
		</center>
	</body>
</html>