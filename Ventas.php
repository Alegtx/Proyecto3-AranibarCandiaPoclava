<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" type="text/css" href="Estilos/Estilo2.css">
		<title>Ventas Registradas</title>
	</head>
	<body>
		<center>
		<header>
			<h1>Supermercado Univalle™</h1>
		</header>
		</center>
		<nav>
			<ul>
				<li><a href="Menu.php">Inicio</a></li>
				<li><a href="Productos/PInicio.php">Productos</a></li>
				<li><a href="Ventas.php">Ventas Registradas</a></li>
				<li><a href="Personas/Registro.php">Personal</a></li>
				<li><a href="tipoPersona/TInicio.php">Tipo de personas</a></li>
			</ul>
		</nav>
		<center>
		<fieldset>
			<h1>Ventas Registradas</h1><hr><br>
			<div align="left"><h3>Tu Cuenta:</h3><h3>
				<?php
					session_start();
					$ci = $_SESSION['usuario'];
					$pass = $_SESSION['clave'];
					require_once("conexion.php");
					$conexion=retornarConexion();
					$registros=mysqli_query($conexion,"select Nombre from Personas as P inner join Login as L on P.CI=L.ci and L.CI = '$ci' and L.Pass='$pass' ") or die("Problemas en el select:".mysqli_error($conexion));
					if ($reg=mysqli_fetch_array($registros))
					{
						echo $reg['Nombre'];
					}
					mysqli_close($conexion);
				?>
				</h3>
			</div>
			<div align="left"><a href="cerrarSesion.php"><input id="f" type="submit" value="Cerrar Sesion"></a></div>
			<div style="width:600px;height:400px;overflow:auto;">
				<?php
				$conexion=retornarConexion();
				$registros=mysqli_query($conexion,"select * from Ventas ") or die("Problemas en el select:".mysqli_error($conexion));
					while ($reg=mysqli_fetch_array($registros))
					{
						echo "<center>"."<h3>"."Codigo de Venta:</h3>"."<h4>".$reg['CodVenta']."</h4>";
						echo "<h3>"."Codigo de Factura:<h3>"."<h4>".$reg['CodFactura']."</h4>";
						echo "<h3>"."Codigo del Carrito:<h3>"."<h4>".$reg['CodCarrito']."</h4>"."<br>";
						echo "<h3>"."NIT del cliente:<h3>"."<h4>".$reg['CodCliente']."</h4>"."<br>";
						echo "<h3>"."Fecha de la Compra:<h3>"."<h4>".$reg['fechaCompra']."</h4>";
						echo "<h3>"."Pago:<h3>"."<h4>".$reg['pago']."</h4>";
						echo "<h3>"."Productos:<h3>"."<h4>".$reg['Productos']."</h4>";
						echo "<h3>"."Cantidad de Productos:<h3>"."<h4>".$reg['cantidadProductos']."</h4><hr><br>";
					}
				?>
			</div>
			<hr>
			<center>
			<h1>Informacion</h1><br>
			<h4>
			Estas son todas las ventas registradas, despues de que el cliente cancela en nuestras sucursales
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