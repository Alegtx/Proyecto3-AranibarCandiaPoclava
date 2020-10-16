<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../Estilos/estilo.css">
		<title>Pedidos</title>
	</head>
	<body>
		<center>
			<?php
				if(!isset($_REQUEST["nomProducto"]) ||!isset($_REQUEST["precio"])||!isset($_REQUEST["CantProductos"]))
				{
					echo "<br>"."<br>"."<br>"."<br>"."<br>"."No a buscado un producto";
					echo "<a href='SuperMercado.php'><h3>Volver al Menu</h3></a>";
				}
				else
				{
					session_start();
					$ci = $_SESSION['nit'];
					$pass = $_SESSION['pass'];
					$NomProductos = $_REQUEST['nomProducto'];
					$precio = $_REQUEST['precio'];
					$CantProductos = $_REQUEST["CantProductos"];
					(integer)$CantProductos;
					$pago = (integer)$CantProductos * $precio;
					require_once("../conexion.php");
					$conexion = retornarConexion();
					$registros = mysqli_query($conexion,"select * from cliente as c inner join pedidos as p on p.CodCliente=c.NIT and c.NIT = '$ci' and c.Password='$pass' ") or die("Problemas en el select:".mysqli_error($conexion));
					if ($reg = mysqli_fetch_array($registros))
					{
						if($reg['EstadoPedido'] == 'Espera')
						{
							echo "<br>"."<br>"."<br>"."<br>"."<br>"."<h3>No puede usar el carrito porque debe cancelar su anterior compra</h3>";
							echo "<a href='SuperMercado.php'><h3>Volver al Menu</h3></a>";
						}
						else
						{
							$CodCarro=$reg['CodCarrito'];
							mysqli_query($conexion,"update Pedidos set NombresProductos=CONCAT(NombresProductos,'|$NomProductos') , CantidadProductos=CONCAT(CantidadProductos,'|$CantProductos') , Pago=Pago+'$pago' where CodCarrito='$CodCarro'") or die("Problemas en el select".mysqli_error($conexion));
							mysqli_query($conexion,"update Productos set Cantidad=Cantidad-'$CantProductos' where Nombre='$NomProductos'") or die("Problemas en el select".mysqli_error($conexion));
							echo "<h2>Producto añadido al Carrito</h2>","<br>";
							echo "<a href='SuperMercado.php'><h3>Seguir Comprando</h3></a>";
							echo "<a href='ConfirmarCompra.php'><h3>Finalizar Compra</h3></a>";
							mysqli_close($conexion);
						}
					}
					else
					{
					echo "<br>"."<br>"."<br>"."<br>"."<br>"."<h2>No existe algun ningun Registro<h2>";
					}
				}
			?>
		</center>
	</body>
</html>