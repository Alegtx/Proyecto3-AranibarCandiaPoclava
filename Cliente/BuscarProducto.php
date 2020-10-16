<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" type="text/css" href="../Estilos/Estilo2.css">
		<title>Buscar producto</title>
		<SCRIPT type="text/javascript">
			function obtenerid(valor){
				var id= valor.id;
				alert("Valor: "+ id);
			}
		</SCRIPT>
	</head>
	<body>
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
		<fieldset>
			<h1>Lista de Productos</h1><hr><br>
			<div style="width:600px;height:100px;overflow:auto;">
				<form method="post">
					<h3>Busca tus productos:<input id="box" type="text" name="search" ><input type="submit" id="j" value="Buscar"></h3>
					<h2>Resultados de Busqueda:</h2>
					<?php
						if(!isset($_REQUEST["search"]))
						{
							echo"No a buscado productos";
						}
						else
						{
							$Busqueda =  $_REQUEST["search"];
							$conexion = retornarConexion();
							$registros = mysqli_query($conexion,"select * from productos where Nombre like '%$Busqueda%' ") or die("Problemas en el select:".mysqli_error($conexion));
							if ($reg=mysqli_fetch_array($registros))
							{
								if ($Busqueda=="")
								{
									echo "No a buscado productos";
								}
								else
								{
									$nombreProducto = $reg['Nombre'];
									$cantProducto = $reg['Cantidad'];
									$Precio = $reg['Precio'];
									echo "<center>"."Nombre:"."<input type='text' required='' value='$nombreProducto' readonly='' name='nomProducto'>"."<br>";
									echo "Stock:"."<input type='text' required='' value='$cantProducto' readonly='' name='stock'>"."<br>";
									echo "Precio:"."<input type='text' required='' value='$Precio' readonly='' name='precio'>"."<br>";
									echo "Cantidad que desea:"."<input type='number' value='1' name='CantProductos' min='1' max='$cantProducto'>"."</center>";
								}
							}
							else
							{
								echo "No existe algun ningun Registro";
							}
							mysqli_close($conexion);
						}
					?>
				</div><br>
				<input id='j' align='left' type='submit' value='Añadir al carrito' onclick = "this.form.action = 'pedidos.php'"><br><br><hr>
			</form>
		</fieldset>
		</center>
		<footer>
			©2020 Supermercado Univalle ™, INC. TODOS LOS DERECHOS RESERVADOS.<br>
			Todas las marcas registradas referenciadas son propiedad de sus respectivos dueños.
		</footer>
	</body>
</html>