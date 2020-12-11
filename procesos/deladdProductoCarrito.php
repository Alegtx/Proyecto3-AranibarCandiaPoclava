<?php
	/*
		Diesño de la matriz: 
		$_SESSION["productos"][X][0] = CodigoProducto
		$_SESSION["productos"][X][1] = Precio
		$_SESSION["productos"][X][2] = Cantidad
	*/
	error_reporting(E_PARSE);
	session_start();
	include '../conexion/configServer.php';
    include '../conexion/consultaSQL.php';

    //Comprobar si existen las variables
	if(isset($_GET['CodProd']) && isset($_GET['Accion']))
	{
		$CodigoProducto = $_GET['CodProd'];
		$Accion = $_GET['Accion'];
		//echo $CodigoProducto;
		switch ($Accion) 
		{
			case 'Aumentar':
				//Obtener el stock maximo
				$verdata = ejecutarSQL::consultar("select * from producto where CodigoProd='".$CodigoProducto."'");
	            $data = mysqli_fetch_array($verdata);
	            $Stock = $data['Stock'];

	            //Recorrer matriz
	            for ($i = 0; $i < $_SESSION['contador']; $i++) 
				{ 
					//Encontrar el prodcuto
					if($CodigoProducto == $_SESSION["productos"][$i+1][0])
					{
						//Comprobar que la cantidad sea menor que el stock
						if($_SESSION["productos"][$i+1][2] < $Stock)
						{
							$_SESSION["productos"][$i+1][2] += 1;
						}
					}
	            }
				break;
			
			case 'Disminuir':
				$Vacio = 0;

				//Recorrer matriz
				for ($i = 0; $i < $_SESSION['contador']; $i++) 
				{ 
					//Encontrar el producto
					if($CodigoProducto == $_SESSION["productos"][$i+1][0])
					{
						//Comprobar que la cantidad sea igual a 1
						if($_SESSION["productos"][$i+1][2] == 1)
						{
							$_SESSION["productos"][$i+1][0] = "";
							$_SESSION["productos"][$i+1][1] = "";
							$_SESSION["productos"][$i+1][2] = "";
						}
						//Si la cantidad no es uno restar la cantidad
						else
						{
							$_SESSION["productos"][$i+1][2] -= 1;
						}
						
					}
					if($_SESSION["productos"][$i+1][0] == "")
					{
						//Si no hay productos en la matriz vaciar todo el carrito
						$Vacio++;
						if($Vacio == $_SESSION['contador'])
						{
							session_start();

							unset($_SESSION['productos']);
							unset($_SESSION['contador']);
							unset($_SESSION['sumaTotal']);
							unset($_SESSION['supermercado']);

							setcookie('Supermercado', "", time() - 3600, "/");
						}
					}
				}
				break;
		}
	}
?>
<script>
	$(document).ready(function() {
	    //Cargar el php en el modal del carrito
	    $('#carrito-compras-tienda').load("procesos/carrito");
    });
</script>