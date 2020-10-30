<?php
    include './conexion/configServer.php';
    include './conexion/consultaSQL.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Pedido</title>
    <?php include './incluir/link.php'; ?>
</head>
<body id="container-page-index">
    <?php include './incluir/navbar.php'; ?>
    <section id="container-pedido">
        <div class="container">
            <div class="page-header">
              <h1>Confirmar pedido</h1>
            </div>
            <br><br><br>
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <img class="img-responsive center-all-contens" src="assets/img/Shopon-line-logo.png" style="opacity: .4">
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div id="form-compra">
                        <form action="procesos/confirmarCompra.php" method="post" role="form" class="FormCatElec" data-form="save">
                            <?php
                                if(!$_SESSION['nombreUser']=="" &&!$_SESSION['claveUser']=="")
                                {
                                    $clientec =  ejecutarSQL::consultar("select * from venta, cliente where venta.NIT=cliente.NIT && cliente.Usuario='".$_SESSION['nombreUser']."'");
                                    while($cliente = mysqli_fetch_array($clientec))
                                    {
                                        $Estado = $cliente['Estado'];                                   
                                        if($Estado == 'Pendiente')
                                        {
                                            break;                                                                                        
                                        }
                                    }
                                    if($Estado = 'Pendiente')
                                    {
                                        echo '
                                            <h2 class="text-center">¿Completaste tu pedido?</h2>
                                            <p class="text-center">Para poder hacer otro pedido debe haber completado el que tienes pendiente primero.</p>
                                            <br>
                                            <img class="img-responsive center-all-contens" src="assets/img/shopping-cart.png">
                                            <br>
                                        ';
                                    }
                                    else
                                    {
                                        echo '
                                            <h2 class="text-center">¿Confirmar pedido?</h2>
                                            <p class="text-center">Para confirmar tu pedido presiona el botón confirmar</p>
                                            <br>
                                            <img class="img-responsive center-all-contens" src="assets/img/shopping-cart.png">
                                              <input type="hidden" name="clien-name" value="'.$_SESSION['nombreUser'].'">
                                              <input type="hidden" name="clien-pass" value="'.$_SESSION['claveUser'].'">
                                              <input type="hidden"  name="clien-number" value="log">
                                            <br>
                                            <p class="text-center"><button class="btn btn-success" type="submit">Confirmar</button></p>
                                        ';
                                    }  
                                }
                                else
                                {
                                    echo '
                                        <h3 class="text-center">¿Confirmar el pedido?</h3>
                                        <p>
                                            Para confirmar tu compra debes haber iniciar sesión o introducir tu nombre de usuario
                                            y contraseña con la cual te registraste en <span class="tittles-pages-logo">Shopon-line</span>.
                                        </p>
                                        <br>
                                    '; 
                                }
                            ?>
                            <div class="ResForm" style="width: 100%; text-align: center; margin: 0;"></div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    <?php include './incluir/footer.php'; ?>
</body>
</html>