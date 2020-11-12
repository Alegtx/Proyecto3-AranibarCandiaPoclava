<?php
    session_start();
    include '../conexion/configServer.php';
    include '../conexion/consultaSQL.php';
    sleep(2);
    $usuario = $_POST['usuario-login'];
    $clave = md5($_POST['clave-login']);
    if(!$usuario == "" && !$clave == "")
    {
        $verUser = ejecutarSQL::consultar("select * from cliente where Usuario='$usuario' and Clave='$clave'");
        $verAdmin = ejecutarSQL::consultar("select * from administrador where Usuario='$usuario' and Clave='$clave'");
        $AdminC = mysqli_num_rows($verAdmin);
        if($AdminC > 0)
        {
            $_SESSION['nombreAdmin'] = $usuario;
            $_SESSION['claveAdmin'] = $clave;
            echo '<script> location.href="index.php"; </script>';
        }
        else
        {
            $UserC = mysqli_num_rows($verUser);
            if($UserC > 0)
            {
                $_SESSION['nombreUser'] = $usuario;
                $_SESSION['claveUser'] = $clave;
                echo '<script> location.href="index"; </script>';
            }
            else
            {
                echo '<img src="assets/img/error.png" class="center-all-contens"><br>Error usuario o contraseña invalido'; 
            }
        }    
    }
    else
    {
        echo '<img src="assets/img/error.png" class="center-all-contens"><br>Error campo vacío<br>Intente nuevamente';
    }
?>