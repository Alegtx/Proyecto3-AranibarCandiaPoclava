<?php
    include '../conexion/configServer.php';
    include '../conexion/consultaSQL.php';
    error_reporting(E_PARSE);
    sleep(5);

    if(isset($_POST['num-pedido']) && isset($_POST['pedido-status']))
    {
        $numeroPedido = $_POST['num-pedido'];
        $estadoPedidoNew = $_POST['pedido-status'];
    }
    
    if($estadoPedidoNew == 'Cancelado')
    {
        echo "
            <script>
                $('#modal-cancelar').modal({show:true});
                $('#cancelar-descripcion').html('<b>Escriba el motivo de cancelacion del pedido: </b>".$numeroPedido."');
                $('#cod-pedido').val('".$numeroPedido."');
                $('#estado-pedido').val('".$estadoPedidoNew."');
            </script>
            ";
    }
    else
    {
        if(isset($_POST['estado-pedido']))
        {
            $estadoPedidoCancel = $_POST['estado-pedido'];
            $numeroPedidoCancel = $_POST['cod-pedido'];
            $motivoCancelacion = $_POST['motivo-cancelacion'];
            if(consultasSQL::UpdateSQL("venta", "Estado='".$estadoPedidoCancel."', MotivoCancelacion='".$motivoCancelacion."'", "NumPedido='".$numeroPedidoCancel."'"))
            {
                consultasSQL::UpdateSQL("venta", "FechaEntrega=Now()", "NumPedido='$numeroPedido'");
                session_start();
                consultasSQL::InsertSQL("registro", "NombreAdmin, Tabla, Accion", "'".$_SESSION['nombreAdmin']."','Venta','Actualizar'");

                echo '
                <br>
                <img class="center-all-contens" src="assets/img/Check.png">
                <p><strong>Hecho</strong></p>
                <p class="text-center">
                    Recargando<br>
                    en 5 segundos
                </p>
                <script>
                    setTimeout(function(){
                    url ="configAdmin";
                    $(location).attr("href",url);
                    },5000);
                </script>
             ';
            }
            else
            {
                echo '
                <br>
                <img class="center-all-contens" src="assets/img/cancel.png">
                <p><strong>Error</strong></p>
                <p class="text-center">
                    Recargando<br>
                    en 5 segundos
                </p>
                <script>
                    setTimeout(function(){
                    url ="configAdmin.php";
                    $(location).attr("href",url);
                    },5000);
                </script>
             ';
            }
        }
        else
        {
            if(consultasSQL::UpdateSQL("venta", "Estado='$estadoPedidoNew'", "NumPedido='$numeroPedido'"))
            {
                //Comprobar si se esta entregando el pedido
                if($estadoPedidoNew == "Entregado"){
                    consultasSQL::UpdateSQL("venta", "FechaEntrega=Now()", "NumPedido='$numeroPedido'");
                }

                session_start();
                consultasSQL::InsertSQL("registro", "NombreAdmin, Tabla, Accion", "'".$_SESSION['nombreAdmin']."','Venta','Actualizar'");

                echo '
                <br>
                <img class="center-all-contens" src="assets/img/Check.png">
                <p><strong>Hecho</strong></p>
                <p class="text-center">
                    Recargando<br>
                    en 5 segundos
                </p>
                <script>
                    setTimeout(function(){
                    url ="configAdmin";
                    $(location).attr("href",url);
                    },5000);
                </script>
             ';
            }
            else
            {
                echo '
                <br>
                <img class="center-all-contens" src="assets/img/cancel.png">
                <p><strong>Error</strong></p>
                <p class="text-center">
                    Recargando<br>
                    en 5 segundos
                </p>
                <script>
                    setTimeout(function(){
                    url ="configAdmin.php";
                    $(location).attr("href",url);
                    },5000);
                </script>
             ';
            }
        }   
    }
?>