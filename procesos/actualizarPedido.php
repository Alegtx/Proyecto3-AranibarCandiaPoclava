<?php
    include '../conexion/configServer.php';
    include '../conexion/consultaSQL.php';

    sleep(5);

    $numeroPedido = $_POST['num-pedido'];
    $estadoPedidoNew = $_POST['pedido-status'];

    if(consultasSQL::UpdateSQL("venta", "Estado='$estadoPedidoNew'", "NumPedido='$numeroPedido'"))
    {
        //Comprobar si se esta entregando el pedido
        if($estadoPedidoNew=="Entregado"){
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
?>