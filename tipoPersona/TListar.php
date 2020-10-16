<?php
//Por si acaso
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" type="text/css" href="../Estilos/Estilo2.css">
		<title>Lista de Tipos de Personas</title>
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
				<li><a href="../PInicio.php">Productos</a></li>
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
			<h1>Lista de Tipos De Personas</h1><br><br>
			<div style="width:600px;height:400px;overflow:auto;">
				<?php
					$conexion=retornarConexion();
					$registros=mysqli_query($conexion,"select * from tipo_personas ") or die("Problemas en el select:".mysqli_error($conexion));
					while ($reg=mysqli_fetch_array($registros))
					{
						echo "<center>"."Codigo:".$reg['Codigo_Tipo_Persona']."<br>";
						echo "Nombre:".$reg['Nombre_TPersona']."<br>";
						echo "Permisos:".$reg['Permisos']."<br>";
						echo "<br>";
						echo "<hr>"."</center>";
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