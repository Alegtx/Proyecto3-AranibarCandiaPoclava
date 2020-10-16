<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" type="text/css" href="../Estilos/Estilo2.css">
		<title>Consultas en la tabla Personas</title>
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
			<h1>Buscar una Persona</h1><hr>
			<center>
			<form action="consulta.php" method="post">
				<h1>Consultas</h1>
				Ingrese el CI de la Persona a consultar:<input type="text" name="ci">
				<input id="e" type="submit" name="buscar" value="buscar">
			</form>
			</center><br><br><hr>
			<div>
				<h1>Resultados</h1>
				<?php
					if(!isset($_REQUEST["ci"]))
					{
						echo "No a realizado ninguna accion";
					}
					else
					{
						$ci=  $_REQUEST["ci"];
						$conexion=retornarConexion();
						$registros=mysqli_query($conexion,"select * from personas where ci='$ci'") or die("Problemas en el select:".mysqli_error($conexion));
						if ($reg=mysqli_fetch_array($registros))
						{
							echo "CI:".$reg['CI']."<br>";
							echo "Nombre:".$reg['Nombre']."<br>";
							echo "Paterno:".$reg['Ap_paterno']."<br>";
							echo "Materno:".$reg['Ap_materno']."<br>";
							echo "Direccion:".$reg['Direccion']."<br>";
							echo "Telefono:".$reg['Telefono']."<br>";
							echo "Celular:".$reg['Celular']."<br>";
							echo "Whatsapp:";
							switch ($reg['whatsaap'])
							{
								case 0: 
									echo "Si tiene","<br>"; 
								break;
								case 1: 
									echo "No tiene","<br>"; 
								break;
							}
							echo "Fecha De Nacimiento:".$reg['Fecha_Nacimiento']."<br>";
							echo "Genero:";
							switch ($reg['Genero'])
							{
								case 0: 
									echo "Masculino","<br>"; 
								break;
								case 1: 
									echo "Femenino","<br>"; 
								break;
							}
							echo "Tipo de Sangre:".$reg['T_Sangre']."<br>";
							echo "Nacionalidad:".$reg['Nacionalidad']."<br>";
							echo "Correo:".$reg['Correo']."<br>";
							echo "Foto:".$reg['Foto']."<br><br><br>"."<hr>";
						}
						else
						{
							echo "No existe algun ningun Registro";
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