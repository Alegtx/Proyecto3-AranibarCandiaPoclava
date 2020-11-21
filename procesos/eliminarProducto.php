<?php
    include '../conexion/configServer.php';
    include '../conexion/consultaSQL.php';

    sleep(4);

    $codProducto = $_POST['prod-cod'];
    $cons = ejecutarSQL::consultar("select * from producto where CodigoProd = '$codProducto'");
    $totalProductos = mysqli_num_rows($cons);
    $tmp = mysqli_fetch_array($cons);
    $imagen = $tmp['Imagen'];
    if($totalProductos > 0)
    {
        if(consultasSQL::DeleteSQL('producto', "CodigoProd='".$codProducto."'"))
        {
            session_start();
            consultasSQL::InsertSQL("registro", "NombreAdmin, Tabla, Accion", "'".$_SESSION['nombreAdmin']."','Producto','Eliminar'");
            
            $carpeta = '../assets/img-productos/';
            $directorio = $carpeta.$imagen;
            chmod($directorio, 0777);
            unlink($directorio);
            echo '<img src="assets/img/correcto.png" class="center-all-contens"><br><p class="lead text-center">El producto se elimino de la tienda con éxito</p>';
        }
        else
        {
            echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Ha ocurrido un error.<br>Por favor intente nuevamente</p>'; 
        }
    }
    else
    {
        echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">El código del producto no existe</p>';
    }
?>
