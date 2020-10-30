<?php
    include '../conexion/configServer.php';
    include '../conexion/consultaSQL.php';

    sleep(5);

    $codProductoOld = $_POST['cod-old-prod'];
    $codProductoNew = $_POST['cod-prod'];
    $nombreProductoNew = $_POST['prod-nombre'];
    $categoriaProductoNew = $_POST['prod-categoria'];
    $precioProductoNew = $_POST['precio-prod'];
    $marcaProductoNew = $_POST['marca-prod'];
    $stockProductoNew = $_POST['stock-prod'];

    if(consultasSQL::UpdateSQL("producto", "CodigoProd='$codProductoNew',NombreProd='$nombreProductoNew',CodigoCat='$categoriaProductoNew',Precio='$precioProductoNew',Marca='$marcaProductoNew',Stock='$stockProductoNew'", "CodigoProd='$codProductoOld'"))
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