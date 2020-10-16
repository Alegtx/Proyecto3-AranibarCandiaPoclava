<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" type="text/css" href="../Estilos/Estilo2.css">
		<title>Registro de Tipo de Personas</title>
	</head>
	<body>
		<center>
		<header>
			<h1>Supermercado Univalle™</h1>
		</header>
		</center>
		<nav>
			<ul>
				<li><a href="../Menu.php">Inicio</a></li>
				<li><a href="../Productos/PInicio.php">Productos</a></li>
				<li><a href="../Ventas.php">Ventas Registradas</a></li>
				<li><a href="../Personas/Registro.php">Personal</a></li>
				<li><a href="TInicio.php">Tipo de personas</a></li>
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
			<h1>Registro de Tipos de Personas</h1>
			<center>
			<form action="TInicio.php" method="post">
				<table border="3">
					<tr>
						<th>Nombre del Tipo de Persona:</th><th><input type="text" name="nom"></th>
					</tr>
					<tr>
						<th>Codigo del Tipo de Persona:</th><th><input type="text" name="Codigo"></th>
					</tr>
					<tr>
						<th>Ingrese Los permisos que tendra:</th><th><input type="text" name="permisos"></th>
					</tr>
				</table>
				<input id="e" type="submit" value="Registrar">
			</form>
			</center>
			<br>
			<a href="TModificar.php"><input id="j" type="submit" value="Modificar"></a>
			<a href="TEliminar.php"><input id="j" type="submit" value="Eliminar"></a>
			<a href="TConsulta.php"><input id="j" type="submit" value="Consulta"></a>
			<a href="TListar.php"><input id="j" type="submit" value="Registros"></a><br><br><br><hr>
			<div>
				<h1>Resultados</h1>
					<?php
						$ci = $_SESSION['usuario'];
						$pass = $_SESSION['clave'];
						$conexion=retornarConexion();
						$registros=mysqli_query($conexion,"select Sistema_Principal from personas as P inner join login as L on P.CI=L.ci and L.CI = '$ci' and L.Pass='$pass' ") or die("Problemas en el select:".mysqli_error($conexion));
						if ($reg=mysqli_fetch_array($registros))
						{
							if($reg['Sistema_Principal']=='UPW004' || $reg['Sistema_Principal']=='UPW005')
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
									$nombre=  $_REQUEST["nom"];
									$codigo =  $_REQUEST["Codigo"];
									$permisos =  $_REQUEST["permisos"];
									$conexion=retornarConexion();
									mysqli_query($conexion,"insert into tipo_personas(Codigo_Tipo_Persona,Nombre_TPersona,Permisos) values ('$codigo','$nombre','$permisos')") or die("Problemas en el select".mysqli_error($conexion));
									mysqli_close($conexion);
									echo "Registro guardado correctamente";
								}
							}
						}
						else
						{
						echo "Necesita Iniciar Sesion";
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