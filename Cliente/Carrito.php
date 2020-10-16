<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" type="text/css" href="../Estilos/Estilo2.css">
		<title>Tu Carrito</title>
	</head>
	<body background="super2.jpg">
		<center>
		<header>
			<h1>Supermercado Univalle™</h1>
		</header>
		</center>
		<nav>
			<ul>
				<li><a href="Supermercado.php">Inicio</a></li>
				<li><a href="Carrito.php">Tu Carrito</a></li>
				<li><a href="Productos.php">Productos</a></li>
				<li><a href="Buscarproducto.php">Buscar productos</a></li>
				<li><a href="Informate.php">Informate</a></li>
			</ul>
		</nav>
		<center>
		<fieldset>
			<h1>Este es tu Carrito</h1><hr><br>
			<div align="left">
				<h3>Tu Cuenta:</h3>
				<?php
					session_start();
					$ci = $_SESSION['nit'];
					$pass = $_SESSION['pass'];
					require_once("../conexion.php");
					$conexion = retornarConexion();
					$registros = mysqli_query($conexion,"select Nombre from cliente as c inner join pedidos as p on p.CodCliente=c.NIT and c.NIT = '$ci' and c.Password='$pass' ") or die("Problemas en el select:".mysqli_error($conexion));
					if ($reg = mysqli_fetch_array($registros))
					{
						echo "<h2>".$reg['Nombre']."</h2>";
					}
					mysqli_close($conexion);
				?>
			</div>
			<div align="left"><a href="CerrarCesion.php"><input id="f" type="submit" value="Cerrar Sesion"></a></div>
			<div style="width:600px;height:250px;overflow:auto;">
				<?php
					$ci = $_SESSION['nit'];
					$pass = $_SESSION['pass'];
					$conexion = retornarConexion();
					$registros = mysqli_query($conexion,"select * from cliente as c inner join pedidos as p on p.CodCliente=c.NIT and c.NIT = '$ci' and c.Password='$pass' ") or die("Problemas en el select:".mysqli_error($conexion));
					while ($reg = mysqli_fetch_array($registros))
					{
						echo "<center>"."<h3>"."Codigo del Carrito:</h3>"."<h4>".$reg['CodCarrito']."</h4>";
						echo "<h3>"."Fecha del pedido:<h3>"."<h4>".$reg['fechaPedido']."</h4>";
						echo "<h3>"."Cliente:<h3>"."<h4>".$reg['CodCliente']."</h4>"."<br>";
						echo "<h3>"."Productos en tu carrito:<h3>"."<h4>".$reg['NombresProductos']."</h4>";
						echo "<h3>"."Cantidad de Productos en tu carrito:<h3>"."<h4>".$reg['CantidadProductos']."</h4>";
						echo "<h3>"."Pago Total:<h3>"."<h4>".$reg['Pago']."</h4>";
						echo "<h3>"."Estado del pedido:<h3>"."<h4>".$reg['EstadoPedido']."</h4>"."</center>";
					}
				?>
			</div>
			<a href='ConfirmarCompra.php'><input id="t" type="submit" value="Finalizar Compra"></a>
			<hr>
			<center>
			<h1>Informacion</h1><hr><br>
			<h4>
				Al momento en que creas tu cuenta se crea tambien tu carrito, con el puedes reservar tus compras en internet y canjear tu carrito en nuestras sucursales, recuerda que tienes que confirmar tu compra en el boton de arriba para canjearlo.<br><br>
				Verifique sus datos antes de Finalizar la compra, ya que no hay devoluciones<br>
			</h4>
			</center>
		</fieldset>
		</center>
		<footer>
			©2020 Supermercado Univalle ™, INC. TODOS LOS DERECHOS RESERVADOS.<br>
			Todas las marcas registradas referenciadas son propiedad de sus respectivos dueños.
		</footer>
	</body>
</html>