<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Supermercado</title>
		<link rel="stylesheet" type="text/css" href="Estilos/estilo.css">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
		<title>Pagar O Cancelar Carrito</title>
	</head>
	<body>
		<center>
			<?php
				session_start();
				$CodCarrito=$_REQUEST["codpedido"];
				$nitcliente=$_REQUEST["nit"];
				$fecha= date("Y-m-d H:i:s");
				require_once("conexion.php");
				$conexion=retornarConexion();
				$registros=mysqli_query($conexion,"select * from pedidos where CodCarrito='$CodCarrito' and CodCliente='$nitcliente' and  EstadoPedido='Espera'") or die("Problemas en el select:".mysqli_error($conexion));
				if ($reg=mysqli_fetch_array($registros))
				{
					$Codventa=rand(1000,9000000);
					$Codventa="CV".$Codventa;
					$Codfactura=rand(1000,9000000);
					$Codfactura="CF".$Codfactura;
					$CodCarro=$reg['CodCarrito'];
					$productos=$reg['NombresProductos'];
					$cantproductos=$reg['CantidadProductos'];
					$pago=$reg['Pago'];
					mysqli_query($conexion,"insert into Ventas(CodVenta,CodFactura,CodCarrito,CodCliente,fechaCompra,pago,Productos,cantidadProductos)values('$Codventa','$Codfactura','$CodCarrito','$nitcliente','$fecha','$pago','$productos','$cantproductos')") or die("Problemas en el select".mysqli_error($conexion));
					mysqli_query($conexion,"update pedidos set EstadoPedido='INACTIVO',NombresProductos='',CantidadProductos='',Pago='0' where CodCarrito='$CodCarro' ") or die("Problemas en el select".mysqli_error($conexion));
					echo "<h4>¡Gracias Por su compra!</h4>";
					echo "<h4>Ya puede seguir comprando utilizando nuestros servicios en linea</h4>";
					echo "<a href='Menu.php'>Volver al Menu</a>";
					mysqli_close($conexion);
				}
				else
				{
					echo "<br>"."<br>"."<br>"."<br>"."<br>"."<h2>No existe algun ningun Registro<h2>";
					echo "<a href='Menu.php'>Volver al Menu</a>";
				}
			?>
		</center>
	</body>
</html>