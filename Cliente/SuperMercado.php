<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Supermercado</title>
		<link rel="stylesheet" type="text/css" href="../Estilos/Estilo2.css">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
		<script language="javascript">
			mydate = new Date();
			myday = mydate.getDay();
			mymonth = mydate.getMonth();
			myweekday = mydate.getDate();
			myyear = mydate.getFullYear();
			weekday = myweekday;
			if(myday == 0)
			day = " Domingo "
			else if(myday == 1)
			day = " Lunes "
			else if(myday == 2)
			day = " Martes "
			else if(myday == 3)
			day = " Miercoles "
			else if(myday == 4)
			day = " Jueves "
			else if(myday == 5)
			day = " Viernes "
			else if(myday == 6)
			day = " Sabado "
			if(mymonth == 0)
			month = "Enero "
			else if(mymonth ==1)
			month = "Febrero "
			else if(mymonth ==2)
			month = "Marzo "
			else if(mymonth ==3)
			month = "Abril "
			else if(mymonth ==4)
			month = "Mayo "
			else if(mymonth ==5)
			month = "Junio "
			else if(mymonth ==6)
			month = "Julio "
			else if(mymonth ==7)
			month = "Agosto "
			else if(mymonth ==8)
			month = "Setiembre "
			else if(mymonth ==9)
			month = "Octubre "
			else if(mymonth ==10)
			month = "Noviembre "
			else if(mymonth ==11)
			month = "Diciembre "
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
		<section>
			<center>
			<fieldset>
				<section>
					<h1>Realiza aqui tu pedido</h1><hr><br>
					<div align="left">
						<h3>Tu Cuenta:</h3>
						<?php
							session_start();
							$ci = $_SESSION['nit'];
							$pass = $_SESSION['pass'];
							require_once "../conexion.php";
							$conexion = retornarConexion();
							$registros = mysqli_query($conexion, "select Nombre from cliente as c inner join pedidos as p on p.CodCliente=c.NIT and c.NIT = '$ci' and c.Password='$pass' ") or die("Problemas en el select:" . mysqli_error($conexion));
							if ($reg = mysqli_fetch_array($registros))
							{
								echo "<h2>" . $reg['Nombre'] . "</h2>";
							}
							mysqli_close($conexion);
						?>
					</div>
					<div align="left"><a href="CerrarCesion.php"><input id="f" type="submit" value="Cerrar Sesion"></a></div>
					<form  method="post">
						<table border="15" align="center">
							<tr>
								<th>
									Codigo del Carrito: <input type="text" value="<?php
										$ci        = $_SESSION['nit'];
										$pass      = $_SESSION['pass'];
										$conexion  = retornarConexion();
										$registros = mysqli_query($conexion, "select CodCarrito from cliente as c inner join pedidos as p on p.CodCliente=c.NIT and c.NIT = '$ci' and c.Password='$pass' ") or die("Problemas en el select:" . mysqli_error($conexion));if ($reg = mysqli_fetch_array($registros)) {echo $reg['CodCarrito'];}
									mysqli_close($conexion);?>" name="codpedido">
								</th>
								<th>Fecha: <div align="left"><script >document.write(day+",");document.write(myweekday+" de "+month+" de "+myyear);</script></div></th>
							</tr>
							<tr>
								<th align="center">Pago Total<input type="text" readonly="" name="pago" value="<?php
											$ci        = $_SESSION['nit'];
											$pass      = $_SESSION['pass'];
											$conexion  = retornarConexion();
											$registros = mysqli_query($conexion, "select Pago from cliente as c inner join pedidos as p on p.CodCliente=c.NIT and c.NIT = '$ci' and c.Password='$pass' ") or die("Problemas en el select:" . mysqli_error($conexion));if ($reg = mysqli_fetch_array($registros)) {echo $reg['Pago'];}
									mysqli_close($conexion);?>">
								</th>
							</tr>
						</table><br><br>
						<input id="t" type="submit" value="Finalizar Compra" onclick = "this.form.action = 'ConfirmarCompra.php'">
						<input id="e" type="submit" value="Ir al carrito" onclick = "this.form.action = 'Carrito.php'">
					</form>
				</section><br><br><hr>
			</fieldset>
			</center>
		</section>
		<footer>
			©2020 Supermercado Univalle ™, INC. TODOS LOS DERECHOS RESERVADOS.<br>
			Todas las marcas registradas referenciadas son propiedad de sus respectivos dueños.
		</footer>
	</body>
</html>