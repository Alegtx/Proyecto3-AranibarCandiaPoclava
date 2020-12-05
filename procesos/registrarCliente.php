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
        //Comprobar captcha
        if($_SESSION['numeroaleatorio'] == $captchaCliente)
        {
            //Comprobar usuario
            $verificarUsuario = ejecutarSQL::consultar("select * from cliente, administrador  where cliente.Usuario = '".$usuarioCliente."' or administrador.Usuario = '".$usuarioCliente."'");
            $usuariostotal = mysqli_num_rows($verificarUsuario);
            if($usuariostotal <= 0)
            {
                //Comprobar NIT
                $verificarNIT =  ejecutarSQL::consultar("select * from cliente where NIT = '".$nitCliente."'");
                $verificaltotal = mysqli_num_rows($verificarNIT);
                if($verificaltotal <= 0)
                {
                    if(consultasSQL::InsertSQL("cliente", "NIT, Usuario, Nombre, Apellidos, Clave, Direccion, Telefono, Email", "'$nitCliente','$usuarioCliente','$nombreCliente','$apeCliente','$passCliente', '$dirCliente','$phoneCliente','$emailCliente'"))
                    {
                        echo '<img src="assets/img/ok.png" class="center-all-contens"><br>El registro se completo con éxito';
                        $_SESSION['nombreUser'] = $usuarioCliente;
                        $_SESSION['claveUser'] = $passCliente;
                        echo '
                            <br>
                            <p><strong>Se le va a redirigir automaticamente.</strong></p>
                            <script>
                                setTimeout(function(){
                                url ="index";
                                $(location).attr("href",url);
                                },3000);
                            </script>
                        ';
                    }
                    else
                    {
                       echo '<img src="assets/img/error.png" class="center-all-contens"><br>Ha ocurrido un error.<br>Por favor intente nuevamente.'; 
                    }
                }
                else
                {
                    echo '
                        <img src="assets/img/error.png" class="center-all-contens"><br>El NIT que ha ingresado ya esta registrado.<br>Por favor ingrese otro nombre de usuario.
                        <script>
                            $("#img-captcha").attr("src","./captcha/Captcha.php");
                        </script>
                        ';
                }
            }
            else
            {
                echo '
                    <img src="assets/img/error.png" class="center-all-contens"><br>El nombre de usuario que ha ingresado ya esta registrado.<br>Por favor ingrese otro número de NIT.
                    <script>
                        $("#img-captcha").attr("src","./captcha/Captcha.php");
                    </script>
                    ';
            }   
        }
        else
        {
            echo '
                <img src="assets/img/error.png" class="center-all-contens"><br>Error el captcha es incorrecto.
                <script>
                    $("#img-captcha").attr("src","./captcha/Captcha.php");
                </script>
                ';
        }
    }
    else 
    {
        echo '
            <img src="assets/img/error.png" class="center-all-contens"><br>Error los campos no deben de estar vacíos
            <script>
                $("#img-captcha").attr("src","./captcha/Captcha.php");
            </script>
        ';
    }
?>
