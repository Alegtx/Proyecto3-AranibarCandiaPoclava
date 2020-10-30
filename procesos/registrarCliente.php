<?php
    include '../conexion/configServer.php';
    include '../conexion/consultaSQL.php';

    sleep(3);
    $nitCliente = $_POST['clien-nit'];
    $usuarioCliente = $_POST['clien-usuario'];
    $nombreCliente = $_POST['clien-nombre'];
    $apeCliente = $_POST['clien-apellidos'];
    $passCliente = md5($_POST['clien-pass']);
    $dirCliente = $_POST['clien-dir'];
    $phoneCliente = $_POST['clien-phone'];
    $emailCliente = $_POST['clien-email'];
    $captchaCliente = $_POST['clien-captcha'];

    if(!$nitCliente == "" && !$usuarioCliente == "" && !$apeCliente == "" && !$dirCliente == "" && !$phoneCliente == "" && !$emailCliente == "" && !$nombreCliente == "")
    {
        session_start();
        if($_SESSION['numeroaleatorio'] == $captchaCliente)
        {
            $verificar =  ejecutarSQL::consultar("select * from cliente where NIT='".$nitCliente."'");
            $verificaltotal = mysqli_num_rows($verificar);
            if($verificaltotal <= 0)
            {
                if(consultasSQL::InsertSQL("cliente", "NIT, Usuario, Nombre, Apellidos, Clave, Direccion, Telefono, Email", "'$nitCliente','$usuarioCliente','$nombreCliente','$apeCliente','$passCliente', '$dirCliente','$phoneCliente','$emailCliente'"))
                {
                    echo '<img src="assets/img/ok.png" class="center-all-contens"><br>El registro se completo con éxito';
                }
                else
                {
                   echo '<img src="assets/img/error.png" class="center-all-contens"><br>Ha ocurrido un error.<br>Por favor intente nuevamente'; 
                }
            }
            else
            {
                echo '<img src="assets/img/error.png" class="center-all-contens"><br>El NIT que ha ingresado ya esta registrado.<br>Por favor ingrese otro número de NIT';
            }
        }
        else
        {
            echo '<img src="assets/img/error.png" class="center-all-contens"><br>Error el captcha es incorrecto';
        }
    }
    else 
    {
        echo '<img src="assets/img/error.png" class="center-all-contens"><br>Error los campos no deben de estar vacíos';
    }
?>
