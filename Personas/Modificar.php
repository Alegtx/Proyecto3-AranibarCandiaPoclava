<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" type="text/css" href="../Estilos/Estilo2.css">
		<title>Modificar Personas</title>
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
				<li><a href="../Productos/PInicio.php">Productos</a></li>
				<li><a href="../Ventas.php">Ventas Registradas</a></li>
				<li><a href="Registro.php">Personal</a></li>
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
			<h1>Modificar Personas</h1><hr>
			<center>
			<form action="Modificar.php" method="post">
				<table border="3">
					<tr>
						<th>Ci que desea modificar:</th><th><input type="text" name="civiejo"></th>
					</tr>
					<tr>
						<th>Direccion:</th><th><input type="text" name="Direc"></th>
					</tr>
					<tr>
						<th>Telefono:</th><th><input type="text" name="Telf"></th>
					</tr>
					<tr>
						<th>Celular:</th><th><input type="text" name="Cel"></th>
					</tr>
					<tr>
						<th>Genero:</th>
						<th>
							<select name="Genero">
								<option value="0">Masculino</option>
								<option value="1">Femenino</option>
							</select>
						</th>
					</tr>
					<tr>
						<th>Tipo de Sangre:</th><th><input type="text" name="TipSang"></th>
					</tr>
					<tr>
						<th>Nacionalidad:</th><th><input type="text" name="Nacionalidad"></th>
					</tr>
					<tr>
						<th>Correo:</th><th><input type="text" name="Correo"></th>
					</tr>
					<tr>
						<th>Whatsapp:</th>
						<th>
							<select name="Whatssap">
								<option value="0">Si,tengo</option>
								<option value="1">No,tengo</option>
							</select>
						</th>
					</tr>
					<tr>
						<th>Url de su foto:</th><th><input type="text" name="Foto"></th>
					</tr>
					<tr>
						<th>Nuevos Permisos Primarios:</th>
						<th>
							<select name="PermisosP">
								<option value="0">SuperUsuario</option>
								<option value="1">Administrador</option>
								<option value="2">Nivel3</option>
								<option value="3">Nivel4</option>
								<option value="4">Nivel3v</option>
								<option value="5">Ninguno</option>
							</select>
						</th>
					</tr>
					<tr>
						<th>Nuevos Permisos Secundarios</th>
						<th>
							<select name="PermisosS">
								<option value="0">SuperUsuario</option>
								<option value="1">Administrador</option>
								<option value="2">Nivel3</option>
								<option value="3">Nivel4</option>
								<option value="4">Nivel3v</option>
								<option value="5">Ninguno</option>
							</select>
						</th>
					</tr>
				</table>
				<input id="e" type="submit" value="Modificar Datos">
			</form>
			</center>
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
								$civiejo = $_REQUEST["civiejo"];
								$direccion =  $_REQUEST["Direc"];
								$telefono =  $_REQUEST["Telf"];
								$celular =  $_REQUEST["Cel"];
								$genero =  $_REQUEST["Genero"];
								$sangre =  $_REQUEST["TipSang"];
								$nacionalidad =  $_REQUEST["Nacionalidad"];
								$correo =  $_REQUEST["Correo"];
								$whatssap =  $_REQUEST["Whatssap"];
								$Foto = $_REQUEST["Foto"];
								$newSP =  $_REQUEST["PermisosP"];
								$newSS = $_REQUEST["PermisosS"];
								if($newSP == 0)
								{
									$newSP = "UPW001";
								}
								elseif ($newSP == 1) 
								{
									$newSP = "UPW002";
								}
								elseif ($newSP == 2) 
								{
									$newSP = "UPW003";
								}
								elseif ($newSP == 3) 
								{
									$newSP = "UPW004";
								}
								elseif ($newSP == 4) 
								{
									$newSP = "UPW005";
								}
								elseif ($newSP == 5) 
								{
									$newSP = "UPW006";
								}
								if($newSS == 0)
								{
									$newSS = "UPW001";
								}
								elseif ($newSS == 1) 
								{
									$newSS = "UPW002";
								}
								elseif ($newSS == 2) 
								{
									$newSS = "UPW003";
								}
								elseif ($newSS == 3) 
								{
									$newSS = "UPW004";
								}
								elseif ($newSS == 4) 
								{
									$newSS = "UPW005";
								}
								elseif ($newSS == 5) 
								{
									$newSS = "UPW006";
								}
								$conexion=retornarConexion();
								$registros = mysqli_query($conexion,"select * from personas where ci = '$civiejo'")or die("Problemas en el Select...".mysqli_error($conexion));
								if ($reg = mysqli_fetch_array($registros))
								{
									mysqli_query($conexion, "update personas set Direccion='$direccion',Telefono='$telefono',Celular='$celular',whatsaap='$whatssap',Genero='$genero',T_Sangre='$sangre',Nacionalidad='$nacionalidad',Correo='$correo',Foto='$Foto' where ci='$civiejo'") or die("Problemas en el select:".mysqli_error($conexion));
									echo "<h2>Los datos fueron modificados con exito</h2>";
									$registros = mysqli_query($conexion,"select * from personas as P inner join Login as L on P.CI=L.ci and L.CI = '$ci' and L.Pass='$pass' ")or die("Problemas en el Select...".mysqli_error($conexion));
									if ($reg = mysqli_fetch_array($registros))
									{
										mysqli_query($conexion, "update login set Sistema_Principal='$newSP',Sistema_Secundario='$newSS' where ci='$civiejo'") or die("Problemas en el select:".mysqli_error($conexion));
										echo "<h2>Los Permisos fueron modificados con exito</h2>";
									}
									else
									{
										echo "<h2>No existe algun ningun Registro</h2>";
									}
								}
								else
								{
									echo "<h2>No existe algun ningun Registro</h2>";
								}
							}
						}
					}
					else
					{
						echo"<h2>Necesita inicar Sesion</h2>";
					}
				?>
			</div><br><hr>
		</fieldset>
		</center>
		<footer>
			©2018 Supermercado Univalle ™, INC. TODOS LOS DERECHOS RESERVADOS.<br>
			Todas las marcas registradas referenciadas son propiedad de sus respectivos dueños.
		</footer>
	</body>
</html>