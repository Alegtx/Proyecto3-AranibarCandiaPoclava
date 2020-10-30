<?php
	session_start();
	include '../conexion/configServer.php';
	include '../conexion/consultaSQL.php';

	sleep(5);
	$codCategoria = $_POST['categ-cod'];
	$cons =  ejecutarSQL::consultar("select * from categoria where CodigoCat='$codCategoria'");
	$totalCategoria = mysqli_num_rows($cons);
	if($totalCategoria > 0)
	{
	    if(consultasSQL::DeleteSQL('categoria', "CodigoCat='".$codCategoria."'"))
	    {
	        echo '<img src="assets/img/correcto.png" class="center-all-contens"><br><p class="lead text-center">Categoría eliminada éxitosamente</p>';
	    }
	    else
	    {
	       echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Ha ocurrido un error.<br>Por favor intente nuevamente</p>'; 
	    }
	}
	else
	{
	    echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">El código de la categoria no existe</p>';
	}
?>