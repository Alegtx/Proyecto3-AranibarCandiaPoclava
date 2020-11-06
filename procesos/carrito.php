<?php
	error_reporting(E_PARSE);
	include '../conexion/configServer.php';
	include '../conexion/consultaSQL.php';
	session_start();
	$suma = 0;
	if(isset($_GET['precio']))
	{
	    $_SESSION['producto'][$_SESSION['contador']] = $_GET['precio'];
	    $_SESSION['contador']++;
	}

	/*Mostrar el primer supermecado*/
	$consulta = ejecutarSQL::consultar("select * from producto where CodigoProd='".$_SESSION['producto'][0]."'");
	while($fila = mysqli_fetch_array($consulta)) 
    {
       $_SESSION['supermercado'] = $fila['NombreAdmin'];
    }
	if($_SESSION['supermercado'] == "")
	{
		echo "Supermercado: - <br><br>";
	}
	else
	{
		echo "Supermercado: ".$_SESSION['supermercado']."<br><br>";
	}

	/*Mostrar productos del carrito*/
	echo '<table class="table table-bordered">';
	for($i = 0; $i < $_SESSION['contador']; $i++)
	{
	    $consulta = ejecutarSQL::consultar("select * from producto where CodigoProd='".$_SESSION['producto'][$i]."'");
		while($fila = mysqli_fetch_array($consulta)) 
	    {
	    	if($_SESSION['supermercado'] == $fila['NombreAdmin'])
	    	{
	    		echo "<tr><td>".$fila['NombreProd']."</td><td> ".$fila['Precio']."</td></tr>";
	    		$suma += $fila['Precio'];
	    		$_SESSION['mensaje'] = "El producto se añadio al carrito correctamente.";
	    	}
	        else
	        {
	        	$_SESSION['contador']--;
	        	$_SESSION['mensaje'] = "Todos los productos deben ser del mismo supermercado.";
	        	//echo "Todos los productos deben ser del mismo supermercado.";
	        }
	    }
	}
	echo "<tr><td>Subtotal</td><td>".number_format($suma,2)." Bs.</td></tr>";
	echo "</table>";
	$_SESSION['sumaTotal'] = $suma;
?>