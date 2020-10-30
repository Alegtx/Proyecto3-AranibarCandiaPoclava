<?php
    session_start();
    include '../conexion/configServer.php';
    include '../conexion/consultaSQL.php';

    sleep(5);
    $usuarioAdmin= $_POST['admin-user'];
    $passAdmin= md5($_POST['admin-pass']);

    if(!$usuarioAdmin=="" && !$passAdmin=="")
    {
        $verificar=  ejecutarSQL::consultar("select * from administrador where Usuario='".$usuarioAdmin."'");
        $verificalTotal = mysqli_num_rows($verificar);
        if($verificalTotal <= 0)
        {
            if(consultasSQL::InsertSQL("administrador", "Usuario, Clave", "'$usuarioAdmin','$passAdmin'"))
            {
                consultasSQL::InsertSQL("registro", "NombreAdmin, Tabla, Accion", "'".$_SESSION['nombreAdmin']."','Administrador','Registrar'");

                echo '<img src="assets/img/correcto.png" class="center-all-contens"><br><p class="lead text-center">Administrador añadido éxitosamente</p>';
            }
            else
            {
               echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Ha ocurrido un error.<br>Por favor intente nuevamente</p>'; 
            }
        }else{
            echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">El nombre que ha ingresado ya existe.<br>Por favor ingrese otro nombre</p>';
        }
    }
    else
    {
        echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Error los campos no deben de estar vacíos</p>';
    }
?>