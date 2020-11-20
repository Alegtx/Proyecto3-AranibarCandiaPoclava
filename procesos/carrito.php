<?php
	/*
		Diesño de la matriz: 
		$_SESSION["productos"][X][0] = CodigoProducto
		$_SESSION["productos"][X][1] = Precio
		$_SESSION["productos"][X][2] = Cantidad
	*/
	error_reporting(E_PARSE);
	include '../conexion/configServer.php';
	include '../conexion/consultaSQL.php';
	session_start();
	$suma = 0;
	$Existe = false;
	if(isset($_GET['CodProd']) && isset($_GET['Cantidad']))
	{
	    $_SESSION['contador']++;
	    /*Obtener precio*/
	    $consulta = ejecutarSQL::consultar("select * from producto where CodigoProd='".$_GET['CodProd']."'");
		while($fila = mysqli_fetch_array($consulta)) 
	    {
	       $Precio = $fila['Precio'] * $_GET['Cantidad'];
	    }

	    /*Recorrer a matriz*/
	    for ($i = 0; $i < $_SESSION['contador']; $i++) 
	    { 
	    	//Comprobar si el producto ya esta en el carrito
	    	if($_GET['CodProd'] == $_SESSION["productos"][$i+1][0])
	    	{
	    		//Matriz de productos
				$_SESSION["productos"][$i+1][0] = $_GET['CodProd'];
				$_SESSION["productos"][$i+1][1] += $Precio;
				$_SESSION["productos"][$i+1][2] += $_GET['Cantidad'];
				$Existe=true;
	    	}
	    	if($i == ($_SESSION['contador']-1) && !$Existe)
	    	{
				$_SESSION["productos"][$_SESSION['contador']][0] = $_GET['CodProd'];
				$_SESSION["productos"][$_SESSION['contador']][1] += $Precio;
				$_SESSION["productos"][$_SESSION['contador']][2] += $_GET['Cantidad'];
	    	}
	    }
	   
		//PRUEBA IMPRIMIR
		//echo $_GET['CodProd']." - ".$Precio." - ".$_GET['Cantidad']." -----";

	}

	//Mostrar el primer supermecado
	$consulta = ejecutarSQL::consultar("select * from producto where CodigoProd='".$_SESSION["productos"][1][0]."'");
	while($fila = mysqli_fetch_array($consulta)) 
    {
       $_SESSION['supermercado'] = $fila['NombreAdmin'];
    }
    //Comprobar si ya hay un supermercado
	if($_SESSION['supermercado'] == "")
	{
		echo "Supermercado: - <br><br>";
	}
	else
	{
		echo "Supermercado: ".$_SESSION['supermercado']."<br><br>";
	}
	
	//Imprimir la matriz
	echo '<table class="table table-bordered">';
	for($i = 0; $i < $_SESSION['contador']; $i++)
	{
		$consulta = ejecutarSQL::consultar("select * from producto where CodigoProd='".$_SESSION["productos"][$i+1][0]."'");
		while($fila = mysqli_fetch_array($consulta)) 
	    {
	    	if($_SESSION['supermercado'] == $fila['NombreAdmin'])
	    	{
	    		if($_SESSION["productos"][$i+1][0] != "")
	    		{
	    			echo "
						<tr>
							<td>".$fila['NombreProd']."</td>
							<td>".$_SESSION["productos"][$i+1][1]."</td>
							<td> x".$_SESSION["productos"][$i+1][2]."</td>
							<td class='no-padding'>
								<a href='procesos/quitarProductoCarrito?CodProd=".$_SESSION["productos"][$i+1][0]."' class='btn btn-danger btn-block btn-sm'><i class='fa fa-trash'></i></a>
							</td>
						</tr>
					";
		    		$suma += $_SESSION["productos"][$i+1][1];
		    		//$_SESSION['mensaje'] = "El producto se añadio al carrito correctamente.";
	    		}	
	    	}
	        else
	        {
	        	$_SESSION['contador']--;
	        	//$_SESSION['mensaje'] = "Todos los productos deben ser del mismo supermercado.";
	        	echo "Todos los productos deben ser del mismo supermercado.";
	        }
	    }
	}
	echo "
		<tr>
			<td>Subtotal</td>
			<td>".number_format($suma, 2)." Bs.</td>
		</tr>
		";
	echo "</table>";
	$_SESSION['sumaTotal'] = $suma;
?>