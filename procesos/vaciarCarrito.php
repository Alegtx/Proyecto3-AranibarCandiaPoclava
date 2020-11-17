<?php
	session_start();

	unset($_SESSION['productos']);
	unset($_SESSION['contador']);
	unset($_SESSION['sumaTotal']);
	unset($_SESSION['supermercado']);
?>
<script>
    window.location = "../index";
</script>
