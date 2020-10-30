<?php
    include '../conexion/configServer.php';
    include '../conexion/consultaSQL.php';

    sleep(5);

    $numeroPedidoNew=$_POST['num-pedido'];
    $estadoPedidonew=$_POST['pedido-status'];


    if(consultasSQL::UpdateSQL("venta", "Estado='$estadoPedidonew'", "NumPedido='$numeroPedidoNew'"))
    {
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
            url ="configAdmin.php";
            $(location).attr("href",url);
            },5000);
        </script>
     ';
    }else{
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