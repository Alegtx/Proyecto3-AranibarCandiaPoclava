<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" type="text/css" href="../Estilos/Estilo2.css">
		<title>Consultas en la tabla Productos</title>
	</head>
	<body background="super2.jpg">
		<center>
		<header>
			<h1>Supermercado Univalle™</h1>
		</header>
		</center>
		<nav>
			<ul>
				<li><a href="../Menu.php">Inicio</a></li>
				<li><a href="PInicio.php">Productos</a></li>
				<li><a href="../Ventas.php">Ventas Registradas</a></li>
				<li><a href="../Personas/Registro.php">Personal</a></li>
				<li><a href="../tipoPersona/TInicio.php">Tipo de personas</a></li>
			</ul>
		</nav>
		<div align="right"><h3>Tu Cuenta:</h3>
			<h3>
				<?php
					session_start();
					$ci = $_SESSION['usuario'];
					$pass = $_SESSION['clave'];
					require_once("../conexion.php");
					$conexion=retornarConexion();
					$registros=mysqli_query($conexion,"select Nombre from personas as P inner join login as L on P.CI=L.ci and L.CI = '$ci' and L.Pass='$pass' ") or die("Problemas en el select:".mysqli_error($conexion));
					if ($reg=mysqli_fetch_array($registros))
					{
						echo $reg['Nombre'];
					}
					mysqli_close($conexion);
				?>
			</h3>
			<br>
		</div>
		<div align="right"><a href="../cerrarSesion.php"><input id="f" type="submit" value="Cerrar Sesion"></a></div>
		<center>
		<fieldset>
			<h1>Buscar a un producto</h1><hr><br>
			<center>
			<form action="PConsulta.php" method="post">
				Codigo del producto que desea buscar:<input type="text" name="cod">
				<input id="e" type="submit" name="buscar" value="buscar">
			</form>
			</center><br><br><hr>
			<div>
				<h1>Resultados</h1>
				<?php
					if(!isset($_REQUEST["cod"]))
					{
						echo"No a realizado ninguna accion";
					}
					else
					{
						$codigo=  $_REQUEST["cod"];
						$conexion=retornarConexion();
						$registros=mysqli_query($conexion,"select * from productos where CodProducto='$codigo'") or die("Problemas en el select:".mysqli_error($conexion));
						if ($reg=mysqli_fetch_array($registros))
						{
							echo "<center>"."Codigo de Producto:".$reg['CodProducto']."<br>";
							echo "Nombre:".$reg['Nombre']."<br>";
							echo "Cantidad:".$reg['Cantidad']."<br>";
							echo "Stock:".$reg['Precio']."<br>";
							echo "<br>";
							echo "<hr>"."</center>";
						}
						else
						{
							echo "<h2>No existe algun ningun Registro<h2>";
						}
						mysqli_close($conexion);
					}
				?>
			</div>
		</fieldset>
		</center>
		<footer>
			©2018 Supermercado Univalle ™, INC. TODOS LOS DERECHOS RESERVADOS.<br>
			Todas las marcas registradas referenciadas son propiedad de sus respectivos dueños.
		</footer>
	</body>
</html>