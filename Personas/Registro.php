<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" type="text/css" href="../Estilos/Estilo2.css">
		<title>Registro de Personas</title>
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
				<li><a href="../Registro.php">Personal</a></li>
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
			<h1>Registro de Personas</h1><hr>
			<center>
			<form action="Registro.php" method="post">
				<table border="3">
					<tr>
						<th>CI:</th><th><input type="text" name="ci"></th>
					</tr>
					<tr>
						<th>Nombre:</th><th><input type="text" name="Nombre"></th>
					</tr>
					<tr>
						<th>Apellido Paterno:</th><th><input type="text" name="ApPa"></th>
					</tr>
					<tr>
						<th>Apellido Materno:</th><th><input type="text" name="ApMa"></th>
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
						<th>Fecha de nacimiento:</th><th><input type="date" name="FecNAc"></th>
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
						<th>Permisos Primarios:</th>
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
						<th>Permisos Secundarios</th>
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
					<tr>
						<th>Confirme el CAPTCHA</th><th><img src="../Captcha/Captcha.php"><br><input type="text" name="numero"></th>
					</tr>
				</table>
				<input id="e" type="submit" value="Registrar">
			</form><br>
			</center>
			<a href="Modificar.php"><input id="j" type="submit" value="Modificar"></a>
			<a href="Eliminar.php"><input id="j" type="submit" value="Eliminar"></a>
			<a href="Consulta.php"><input id="j" type="submit" value="Consulta"></a>
			<a href="Listar.php"><input id="j" type="submit" value="Registros"></a><br><br><hr>
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
							if(!isset($_REQUEST["ci"]))
							{
								echo "No a realizado ninguna accion";
							}
							else
							{
								$ci =  $_REQUEST["ci"];
								$nombre =  $_REQUEST["Nombre"];
								$paterno =  $_REQUEST["ApPa"];
								$materno =  $_REQUEST["ApMa"];
								$direccion =  $_REQUEST["Direc"];
								$telefono =  $_REQUEST["Telf"];
								$celular =  $_REQUEST["Cel"];
								$nacimiento =  $_REQUEST["FecNAc"];
								$genero =  $_REQUEST["Genero"];
								$sangre =  $_REQUEST["TipSang"];
								$nacionalidad =  $_REQUEST["Nacionalidad"];
								$correo =  $_REQUEST["Correo"];
								$whatssap =  $_REQUEST["Whatssap"];
								$Foto =$_REQUEST["Foto"];
								$fecha = date("Y-m-d H:i:s");
								$Sprincipal = $_REQUEST["PermisosP"];
								$Ssecundario = $_REQUEST["PermisosS"];
								$Captcha = $_REQUEST['numero'];
								if($Sprincipal == 0)
								{
									$Sprincipal = "UPW001";
								}
								elseif ($Sprincipal == 1) 
								{
									$Sprincipal = "UPW002";
								}
								elseif ($Sprincipal == 2) 
								{
									$Sprincipal = "UPW003";
								}
								elseif ($Sprincipal == 3) 
								{
									$Sprincipal = "UPW004";
								}
								elseif ($Sprincipal == 4) 
								{
									$Sprincipal = "UPW005";
								}
								elseif ($Sprincipal == 5) 
								{
									$Sprincipal = "UPW006";
								}
								if($Ssecundario == 0)
								{
									$Ssecundario = "UPW001";
								}
								elseif ($Ssecundario == 1) 
								{
									$Ssecundario = "UPW002";
								}
								elseif ($Ssecundario == 2) 
								{
									$Ssecundario = "UPW003";
								}
								elseif ($Ssecundario == 3) 
								{
									$Ssecundario = "UPW004";
								}
								elseif ($Ssecundario == 4) 
								{
									$Ssecundario = "UPW005";
								}
								elseif ($Ssecundario == 5) 
								{
									$Ssecundario = "UPW006";
								}
								$pass=rand(1000,9000);
								$conexion=retornarConexion();
								if ($_SESSION['numeroaleatorio'] == $Captcha)
								{
									mysqli_query($conexion,"insert into personas(CI,Nombre,Ap_paterno,Ap_materno,Direccion,Telefono,Celular,whatsaap,Fecha_Nacimiento,Genero,T_Sangre,Nacionalidad,Correo,Foto) values
									('$ci','$nombre','$paterno','$materno','$direccion','$telefono','$celular','$whatssap','$nacimiento','$genero','$sangre','$nacionalidad','$correo','$Foto')") or die("Problemas en el select".mysqli_error($conexion));
									mysqli_query($conexion,"insert into login(CI,Pass,fecha,Sistema_Principal,Sistema_Secundario) values
									('$ci','$pass','$fecha','$Sprincipal','$Ssecundario')") or die("Problemas en el select".mysqli_error($conexion));
									mysqli_close($conexion);
									echo "<h1>Guardado correctamente!</h1>","<br>","<br>";
									echo "<h2>Su Codigo de Usuario es:</h2>",$ci,"<br>";
									echo "<h2>Su Password es:</h2>",$pass,"<br>";
									echo "<h2>Esta Password es un numero random te recomendamos cambiarla una vez ingreses al sistema</h2>","<br>";
								}
								else
								{
									echo "<h3>Captcha incorrecto</h3>","<br>";
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
			©2020 Supermercado Univalle ™, INC. TODOS LOS DERECHOS RESERVADOS.<br>
			Todas las marcas registradas referenciadas son propiedad de sus respectivos dueños.
		</footer>
	</body>
</html>