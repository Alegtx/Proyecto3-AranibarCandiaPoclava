<?php
    session_start();
    include '../conexion/configServer.php';
    include '../conexion/consultaSQL.php';

    sleep(5);
    $codigoCategoria= $_POST['categ-cod'];
    $nombreCategoria= $_POST['categ-nombre'];
    $descCategoria= $_POST['categ-desc'];

    if(!$codigoCategoria == "" && !$nombreCategoria == "" && !$descCategoria == "")
    {
        $verificar =  ejecutarSQL::consultar("select * from categoria where CodigoCat='".$codigoCategoria."'");
        $verificalTotal = mysqli_num_rows($verificar);
        if($verificalTotal <= 0)
        {
            if(consultasSQL::InsertSQL("categoria", "CodigoCat, Nombre, Descripcion", "'$codigoCategoria','$nombreCategoria','$descCategoria'"))
            {
                consultasSQL::InsertSQL("registro", "NombreAdmin, Tabla, Accion", "'".$_SESSION['nombreAdmin']."','Categoria','Registrar'");

                echo '<img src="assets/img/correcto.png" class="center-all-contens"><br><p class="lead text-center">Categoría añadida éxitosamente</p>';
            }
            else
            {
               echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Ha ocurrido un error.<br>Por favor intente nuevamente</p>'; 
            }
        }
        else
        {
            echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">El código que ha ingresado ya existe.<br>Por favor ingrese otro código</p>';
        }
    }
    else
    {
        echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Error los campos no deben de estar vacíos</p>';
    }
?>