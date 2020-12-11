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
                            <form action="procesos/Khipu" method="post" role="form" class="FormCatElec" data-form="save">
                                <?php
                                    if(!$_SESSION['nombreUser'] == "" && !$_SESSION['claveUser'] == "")
                                    {
                                        $clientec = ejecutarSQL::consultar("select * from venta, cliente where venta.NIT=cliente.NIT && cliente.Usuario='".$_SESSION['nombreUser']."'");
                                        while($cliente = mysqli_fetch_array($clientec))
                                        {
                                            $Estado = $cliente['Estado'];                                   
                                            if($Estado == 'Pendiente')
                                            {
                                                break;                                                                                        
                                            }
                                        }
                                        if($Estado == 'Pendiente')
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
                                                <p class="text-center">
                                                    Primero seleciona la fecha en que quieres recoger tu pedido.<br>
                                                    <input type="date" id="fecha-recogo" name="fecha-recogo" required>
                                                </p>
                                                <p class="text-center help-block"><small>La fecha para recoger su pedido solo puede ser hasta 1 mes como maximo.</small></p>
                                                <p class="text-center">
                                                    Y para concluir la hora a la que lo quieres recoger.<br>
                                                    <input type="time" id="hora-recogo" name="hora-recogo" min="08:00" max="22:00" required>
                                                </p><br>
                                                <img class="img-responsive center-all-contens" src="assets/img/shopping-cart.png">
                                                <br>
                                                <p class="text-center">Para confirmar tu pedido presiona el botón confirmar tu pedido y proceder al pago.</p>
                                                <p class="text-center"><input type="image" src="https://s3.amazonaws.com/static.khipu.com/buttons/2015/200x75-transparent.png"></p>
                                            ';
                                        }  
                                    }
                                    else
                                    {
                                        if($_SESSION['nombreAdmin'] != "")
                                        {
                                            echo '
                                                <h1 class="text-center"><i class="fa fa-exclamation-triangle fa-4x"></i></h1>
                                                <b><p class="text-center">
                                                    Los supermercados no pueden hacer pedidos.
                                                </p></b>
                                                <br>
                                            ';
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