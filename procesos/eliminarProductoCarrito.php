<?php
	error_reporting(E_PARSE);
	session_start();
	if(isset($_GET['CodProd']))
	{
		$CodigoProducto = $_GET['CodProd'];
		//echo $CodigoProducto;
		$Vacio = 0;
		for ($i = 0; $i < $_SESSION['contador']; $i++) 
		{ 
			//Quitar un producto de la matriz
			if($_GET['CodProd'] == $_SESSION["productos"][$i+1][0])
			{
				$_SESSION["productos"][$i+1][0] = "";
				$_SESSION["productos"][$i+1][1] = "";
				$_SESSION["productos"][$i+1][2] = "";
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
	}
?>
<script>
	$(document).ready(function() {
	    //Cargar el php en el modal del carrito
	    $('#carrito-compras-tienda').load("procesos/carrito");
    });
</script>