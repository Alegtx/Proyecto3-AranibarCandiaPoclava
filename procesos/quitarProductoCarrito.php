<?php
	error_reporting(E_PARSE);
	session_start();
	if(isset($_GET['CodProd']))
	{
		$CodigoProducto = $_GET['CodProd'];
		//echo $CodigoProducto;
		for ($i = 0; $i < $_SESSION['contador']; $i++) 
		{ 
			if($_GET['CodProd'] == $_SESSION["productos"][$i+1][0])
			{
				$_SESSION["productos"][$i+1][0] = "";
				$_SESSION["productos"][$i+1][1] = "";
				$_SESSION["productos"][$i+1][2] = "";
			}
		}
	}
?>
<script>
    window.location = "../index";
</script>