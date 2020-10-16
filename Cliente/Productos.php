<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" type="text/css" href="../Estilos/Estilo2.css">
		<title>Lista de Productos</title>
		<script type="text/javascript">
			function obtenerid(valor){
				var id= valor.id;
				alert("Valor: "+ id);
			}
		</script>
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
			$ci   = $_SESSION['nit'];
			$pass = $_SESSION['pass'];
			require_once "../conexion.php";
			$conexion  = retornarConexion();
			$registros = mysqli_query($conexion, "select Nombre from cliente as c inner join pedidos as p on p.CodCliente=c.NIT and c.NIT = '$ci' and c.Password='$pass' ") or die("Problemas en el select:" . mysqli_error($conexion));
			if ($reg = mysqli_fetch_array($registros)) 
			{
				echo "<h2>" . $reg['Nombre'] . "</h2>";
			}
			mysqli_close($conexion);
			?>
		</div>
		<div align="left"><a href="CerrarCesion.php"><input id="f" type="submit" value="Cerrar Sesion"></a></div>
		<fieldset>
			<br><h2>Todos nuestros productos:</h2><br><hr><br>
			<div style="width:600px;height:800px;overflow:auto;">
				<?php
					$conexion  = retornarConexion();
					$registros = mysqli_query($conexion, "select * from productos ") or die("Problemas en el select:" . mysqli_error($conexion));
					while ($reg = mysqli_fetch_array($registros)) 
					{
						$cantProducto = $reg['Cantidad'];
						echo "<center>" . "<form method='post'>" . "Nombre:" . $reg['Nombre'] . "<br>";
						echo "Stock:" . $reg['Cantidad'] . "<br>";
						echo "Precio:" . $reg['Precio'] . "<br>";
						echo "Cantidad que desea:" . "<input type='number' value='1' name='CantProductos' min='1' max='$cantProducto'>";
						echo "<a href='Carrito.php'><input id='t' type='submit' value='Añadir al carrito'></a>";
						echo "<br>" . "<hr>" . "</form>" . "</center>";
					}
				?>
			</div>
		</fieldset>
		</center>
		<footer>
			©2020 Supermercado Univalle ™, INC. TODOS LOS DERECHOS RESERVADOS.<br>
			Todas las marcas registradas referenciadas son propiedad de sus respectivos dueños.
		</footer>
	</body>
</html>