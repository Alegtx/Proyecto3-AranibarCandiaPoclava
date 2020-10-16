<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Supermercado</title>
		<link rel="stylesheet" type="text/css" href="Estilos/Estilo2.css">
	</head>
	<body>
		<center>
		<header>
			<h1>Supermercado Univalle™</h1>
		</header>
		</center>
		<nav>
			<ul>
				<li><a href="Menu.php">Inicio</a></li>
				<li><a href="Productos/PInicio.php">Productos</a></li>
				<li><a href="Ventas.php">Ventas Registradas</a></li>
				<li><a href="Personas/Registro.php">Personal</a></li>
				<li><a href="tipoPersona/TInicio.php">Tipo de personas</a></li>
			</ul>
		</nav>
		<div align="right">
			<h3>Tu Cuenta:</h3>
			<h3>
			<?php
				session_start();
				$ci = $_SESSION['usuario'];
				$pass = $_SESSION['clave'];
				require_once("conexion.php");
				$conexion=retornarConexion();
				$registros=mysqli_query($conexion,"select Nombre from personas as P inner join login as L on P.CI=L.ci and L.ci = '$ci' and L.Pass='$pass' ") or die("Problemas en el select:".mysqli_error($conexion));
				if ($reg=mysqli_fetch_array($registros))
				{
					echo $reg['Nombre'];
				}
				mysqli_close($conexion);
			?>
			</h3>
		</div>
		<div align="right"><a href="cerrarSesion.php"><input id="f" type="submit" value="Cerrar Sesion"></a></div>
		<section>
			<center>
			<fieldset>
				<section>
					<h1>Pedidos</h1><hr>
					<form  method="post">
						<table border="15" align="center">
							<tr>
								<th>Codigo del Carrito: <input type="text" required="" name="codpedido" value="<?php if (isset($_POST['codpedido'])){ echo $_POST['codpedido']; } ?>"></th>
							</tr>
							<tr>
								<th >NIT Cliente:<input type="text" required=""  name="nit" value="<?php if (isset($_POST['nit'])){ echo $_POST['nit']; } ?>"></th>
							</tr>
						</table>
						<input type="submit" id="j" value="Buscar" name="buscar">
						<div style="width:700px;height:400px;overflow:auto;">
							<h3>Resultados de Busqueda:</h3>
							<?php
								$conexion=retornarConexion();
								if(!isset($_REQUEST["codpedido"]) ||!isset($_REQUEST["nit"]))
								{
									echo "No a buscado pedidos"."<br>";
								}
								else
								{
									$CodCarrito=$_REQUEST["codpedido"];
									$nitcliente=$_REQUEST["nit"];
									$conexion=retornarConexion();
									$registros=mysqli_query($conexion,"select * from pedidos where CodCarrito='$CodCarrito' and CodCliente='$nitcliente' and  EstadoPedido='Espera'") or die("Problemas en el select:".mysqli_error($conexion));
									if ($reg=mysqli_fetch_array($registros))
									{
										echo "<center>";
										echo "<h4>"."Codigo del Carrito:".$reg['CodCarrito']."<br>";
										echo "Fecha del pedido:".$reg['fechaPedido']."<br>";
										echo "Cliente:".$reg['CodCliente']."<br>";
										echo "Productos en tu carrito:".$reg['NombresProductos']."<br>";
										echo "Cantidad de Productos en tu carrito:".$reg['CantidadProductos']."<br>";
										echo "Pago Total:".$reg['Pago']."<br>";
										echo "Estado del pedido:".$reg['EstadoPedido']."</h4>";
										echo "</center>";
									}
									else
									{
										echo "No existe algun ningun Registro"."<br>";
									}
									mysqli_close($conexion);
								}
							?>
							<input id="t" type="submit" value="Finalizar Compra" onclick = "this.form.action = 'PagoCancelar_Cajas.php'">
						</div><br>
					</form>
				</section><br><hr><br>
				<h2>Lista de espera</h2><br>
				<div style="width:600px;height:250px;overflow:auto;">
					<?php
						$conexion=retornarConexion();
						$registros=mysqli_query($conexion,"select * from cliente as c inner join pedidos as p on p.CodCliente=c.NIT and  EstadoPedido='Espera'") or die("Problemas en el select:".mysqli_error($conexion));
						while ($reg=mysqli_fetch_array($registros))
						{
							echo "<center>"."Codigo del Carrito:".$reg['CodCarrito']."<br>";
							echo "Fecha del pedido:".$reg['fechaPedido']."<br>";
							echo "Cliente:".$reg['CodCliente']."<br>";
							echo "Productos en tu carrito:".$reg['NombresProductos']."<br>";
							echo "Cantidad de Productos en tu carrito:".$reg['CantidadProductos']."<br>";
							echo "Pago Total:".$reg['Pago']."<hr>"."</center>"."<br>";
						}
						mysqli_close($conexion);
					?>
				</div>
				<br><br><br><hr>
			</fieldset>
			</center>
		</section>
		<footer>
			©2020 Supermercado Univalle ™, INC. TODOS LOS DERECHOS RESERVADOS.<br>
			Todas las marcas registradas referenciadas son propiedad de sus respectivos dueños.
		</footer>
	</body>
</html>