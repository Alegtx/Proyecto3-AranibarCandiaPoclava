<?php
	session_start();
	unset($_SESSION['productos']);
	unset($_SESSION['contador']);
	unset($_SESSION['sumaTotal']);
	unset($_SESSION['supermercado']);

	setcookie('Supermercado', "", time() - 3600, "/");
?>
<script>
	$(document).ready(function() {
	    //Cargar el php en el modal del carrito
	    $('#carrito-compras-tienda').load("procesos/carrito");
    });
</script>