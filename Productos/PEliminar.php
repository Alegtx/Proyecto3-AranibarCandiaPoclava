<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" type="text/css" href="../Estilos/Estilo2.css">
		<title>Eliminar a un Producto</title>
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
			<h1>Eliminar a un Producto</h1><hr>
			<center>
			<form action="PEliminar.php" method="post">
				Ingrese el Codigo del producto a eliminar:
				<input type="text" name="cod">
				<input id="e" type="submit" value="Eliminar">
			</form>
			</center><br><br><hr>
			<div>
				<h1>Resultados</h1>
				<?php
					$ci = $_SESSION['usuario'];
					$pass = $_SESSION['clave'];
						$conexion=retornarConexion();
					$registros=mysqli_query($conexion,"select Sistema_Principal from personas as P inner join login as L on P.CI=L.ci and L.CI = '$ci' and L.Pass='$pass' ") or die("Problemas en el select:".mysqli_error($conexion));
					if ($reg=mysqli_fetch_array($registros))
					{
						if($reg['Sistema_Principal']=='UPW001')
						{
							if(!isset($_REQUEST["cod"]))
							{
								echo "No a realizado ninguna accion";
							}
							else
							{
								$cod=$_REQUEST["cod"];
								$conexion=retornarConexion();
								$registros = mysqli_query($conexion,"select * from productos where CodProducto = '$cod'")or die("Problemas en el Select...".mysqli_error($conexion));
								if ($reg = mysqli_fetch_array($registros))
								{
									mysqli_query($conexion,"delete from productos where CodProducto = '$cod'") or die("Problemas en el Select...".mysqli_error($conexion));
									echo "Se efectuo el borrado del Producto";
								}
								else
								{
									echo "No existe algun ningun Registro";
								}
								mysqli_close($conexion);
							}
						}
						else
						{
							echo "<H2>Usted no tiene acceso para realizar esta transaccion</H2>";
						}
					}
					else
					{
						echo"<h2>Necesita inicar Sesion</h2>";
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