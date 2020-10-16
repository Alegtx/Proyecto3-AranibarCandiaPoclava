<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" type="text/css" href="../Estilos/Estilo2.css">
		<title>Modificar Tipos de Personas</title>
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
			<h1>Modificar Tipos De Personas</h1><hr>
			<center>
			<form action="PModificar.php" method="post">
				<table border="3">
					<tr>
						<th>Codigo del producto que desea modificar:</th><th><input type="text" name="cod"></th>
					</tr>
					<tr>
						<th>Nuevo nombre:</th><th><input type="text" name="nom"></th>
					</tr>
					<tr>
						<th>Nuevo Stock:</th><th><input type="text" name="stock"></th>
					</tr>
					<tr>
						<th>Nuevo Precio:</th><th><input type="text" name="precio"></th>
					</tr>
				</table><br>
				<input id="e" type="submit" value="Modificar">
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
						if($reg['Sistema_Principal']=='UPW003'||$reg['Sistema_Principal']=='UPW004' || $reg['Sistema_Principal']=='UPW005')
						{
							echo "<H2>Usted no tiene acceso para realizar esta transaccion</H2>";
						}
						else
						{
							if(!isset($_REQUEST["cod"]))
							{
								echo"No a realizado ninguna accion";
							}
							else
							{
								$codigo=  $_REQUEST["cod"];
								$nombre =  $_REQUEST["nom"];
								$stock =  $_REQUEST["stock"];
								$precio =  $_REQUEST["precio"];
								$conexion=retornarConexion();
								$registros = mysqli_query($conexion,"select * from productos where CodProducto = '$codigo'")or die("Problemas en el Select...".mysqli_error($conexion));
								if ($reg = mysqli_fetch_array($registros))
								{
									mysqli_query($conexion, "update productos set Nombre='$nombre',Cantidad='$stock' where CodProducto = '$codigo'") or die("Problemas en el select:".mysqli_error($conexion));
									echo "<H2>Los datos fueron modificados con exito</h2>";
								}
								else
								{
									echo "<H2>No existe algun ningun Registro</H2>";
								}
							}
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