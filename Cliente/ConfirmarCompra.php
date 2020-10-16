<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Supermercado</title>
		<link rel="stylesheet" type="text/css" href="../Estilos/estilo.css">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
		<title>Confirmar Carrito</title>
	</head>
	<body>
		<center>
			<?php
				session_start();
				$ci = $_SESSION['nit'];
				$pass = $_SESSION['pass'];
				$fecha = date("Y-m-d H:i:s");
				require_once("../conexion.php");
				$conexion = retornarConexion();
				$registros = mysqli_query($conexion,"select * from cliente as c inner join pedidos as p on p.CodCliente=c.NIT and c.NIT = '$ci' and c.Password='$pass' ") or die("Problemas en el select:".mysqli_error($conexion));
				if ($reg = mysqli_fetch_array($registros))
				{
					if($reg['NombresProductos']==''||$reg['CantidadProductos']==''||$reg['Pago']=='0')
					{
						echo "<br>"."<br>"."<br>"."<br>"."<br>"."<h3>Tiene que registrar por lo menos 1 producto en su carrito</h3>";
						echo "<a href='SuperMercado.php'><h3>Volver al Menu</h3></a>";
					}
					else
					{
						if($reg['EstadoPedido']=='Espera')
						{
							echo "<br>"."<br>"."<br>"."<br>"."<br>"."<h3>No puede usar el carrito porque debe cancelar su anterior compra</h3>";
							echo "<a href='SuperMercado.php'><h3>Volver al Menu</h3></a>";
						}
						else
						{
							$CodCarro = $reg['CodCarrito'];
							mysqli_query($conexion,"update pedidos set EstadoPedido='Espera',fechaPedido='$fecha' where CodCarrito='$CodCarro'") or die("Problemas en el select".mysqli_error($conexion));
							echo "<br>"."<h2>¡Tu carrito fue registrado exitosamente!</h2>"."<br>";
							echo "<br>"."<h2>Tienes un maximo de 30 dias para cancelar y canjear tu compra en nuestras sucursales</h2>"."<br>";
							echo "<h3>El codigo para canjear es: ",$CodCarro," con tu NIT</h3>"."<br>";
							echo "<h3>No podras hacer otro Pedido hasta que Pagues tu Carrito</h3>"."<br>";
							echo "<a href='SuperMercado.php'>Volver al Menu</a>";
							mysqli_close($conexion);
						}
					}
				}
				else
				{
					echo "<br>"."<br>"."<br>"."<br>"."<br>"."<h2>No existe algun ningun Registro<h2>";
				}
			?>
		</center>
	</body>
</html>