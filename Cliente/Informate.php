<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" type="text/css" href="../Estilos/Estilo2.css">
		<title>Lista de Productos</title>
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
				<li><a href="Carrito.php">Carrito</a></li>
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
			<h1>Conocenos</h1>
			<hr>
			<div style="width:600px;height:300px">
				<table align="center" >
					<tr>
						<th style="color: orange" >SupermercadoUnivalle</th><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
						<th style="color: orange">Sucursales</th>
					</tr>
					<tr>
						<td>SupermercadoUnivalle es el primer supermercado del pais que cuenta con productos clasificados,diversas secciones para que el cliente obtenga lo que busca</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>
							SupermercadoUnivalle es la cadena mas mas grande del pais,contamos mas de 100 locales a nivel nacional en las que ofremos los profuctos para satisfacer todas las necesidades de nuestros clientes
						</td>
					</tr>
				</table>
				<h1 style="color: orange">Contactenos</h1>
				<table>
					<tr>
						<td>
							Todas sus dudas,comentarios y sugerencias,son bienvenidas.
							Contactenos por cualquiera de estos medios
						</td>
					</tr>
					<td align="center"> <a href="https://twitter.com/"><img src="icono2.jpg" width="70" height="70"></a><a href="http://facebook.com"><img src="icono1.jpg" width="70" height="70"></a></td>
				</table>
				<h1 style="color: orange">Nuestra Vision</h1>
				<table>
					<tr>
						<td>
							Nuestra visión es ser el supermercado líder en comercialización de alimentos y productos de consumo masivo en Bolivia, con una oferta de productos de primera calidad, al mejor precio.
						</td>
					</tr>
					
				</table >
				<h1 style="color: orange">Términos y condiciones</h1>
				<table width="500"  >
					<tr>
						<td>
							Los derechos de propiedad intelectual respecto de los contenidos, así como los derechos de uso y explotación de los mismos, incluyendo su divulgación, publicación, reproducción, distribución y transformación, son propiedad exclusiva de Supermercado Univalle. El usuario no podrá utilizar los contenidos de este sitio web con fines distintos a los que se contemplan en los presentes Términos y Condiciones de Uso y Privacidad.<br>
						</td>
					</tr>
					<tr>
						<td>
							El supermercado, ni sus empresas asociadas, proveedores o socios comerciales serán responsables de cualquier daño o perjuicio que sufra el usuario a consecuencia de inexactitudes
						</td>
					</tr>
				</table>
			</div>
		</fieldset>
		</center>
		<footer>
			©2020 Supermercado Univalle ™, INC. TODOS LOS DERECHOS RESERVADOS.<br>
			Todas las marcas registradas referenciadas son propiedad de sus respectivos dueños.
		</footer>
	</body>
</html>