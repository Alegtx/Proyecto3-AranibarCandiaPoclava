<?php
	session_start();
	include '../conexion/configServer.php';
	include '../conexion/consultaSQL.php';

	sleep(5);
	$usuarioAdmin= $_POST['name-admin'];
	$consA=  ejecutarSQL::consultar("select * from administrador where Usuario='$usuarioAdmin'");
	$totalA = mysqli_num_rows($consA);

	if($totalA>0)
	{
	    if(consultasSQL::DeleteSQL('administrador', "Usuario='".$usuarioAdmin."'"))
	    {
	        echo '<img src="assets/img/correcto.png" class="center-all-contens"><br><p class="lead text-center">Administrador eliminado éxitosamente</p>';
	    }
	    else
	    {
	       echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Ha ocurrido un error.<br>Por favor intente nuevamente</p>'; 
	    }
	}
	else
	{
	    echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">El nombre del administrador no existe</p>';
	}
?>