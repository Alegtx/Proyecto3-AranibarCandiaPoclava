<?php
	session_start();

	unset($_SESSION['productos']);
	unset($_SESSION['contador']);
	unset($_SESSION['sumaTotal']);
	unset($_SESSION['supermercado']);

	setcookie('Supermercado', "", time() - 3600, "/");
?>
<script>
    window.location = "../index";
</script>
