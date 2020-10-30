<?php
    include '../conexion/configServer.php';
    include '../conexion/consultaSQL.php';

    sleep(5);

    $codCategoriaOld = $_POST['categ-cod-old'];
    $codCategoriaNew = $_POST['categ-cod'];
    $nombreCategoriaNew = $_POST['categ-nombre'];
    $descCategoriaNew = $_POST['categ-desc'];

    if(consultasSQL::UpdateSQL("categoria", "CodigoCat = '$codCategoriaNew', Nombre = '$nombreCategoriaNew', Descripcion = '$descCategoriaNew'", "CodigoCat = '$codCategoriaOld'"))
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