<?php
    include './conexion/configServer.php';
    include './conexion/consultaSQL.php';
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Productos</title>
        <?php include './incluir/link.php'; ?>
    </head>
    <body id="container-page-product">
        <?php include './incluir/navbar.php'; ?>
        <section id="infoproduct">
            <div class="container">
                <div class="row">
                    <div class="page-header">
                        <h1>Tienda <small class="tittles-pages-logo">Shopon-line</small></h1>
                    </div>
                    <?php 
                        $CodigoProducto = $_GET['CodigoProd'];
                        $productoinfo =  ejecutarSQL::consultar("select * from producto where CodigoProd='".$CodigoProducto."'");
                        while($fila = mysqli_fetch_array($productoinfo))
                        {
                            echo '
                                <div class="col-xs-12 col-sm-6">
                                    <h3 class="text-center">Información de producto</h3>
                                    <br><br>
                                    <h4><strong>Nombre: </strong>'.$fila['NombreProd'].'</h4><br>
                                    <h4><strong>Marca: </strong>'.$fila['Marca'].'</h4><br>
                                    <h4><strong>Precio: </strong>'.$fila['Precio'].'</h4>
                                    <h4><strong>Stock: </strong>'.$fila['Stock'].'</h4>
                                    <h4><strong>Supermercado: </strong>'.$fila['NombreAdmin'].'</h4>
                                    <h4>
                                        <strong>Cantidad a comprar: </strong>
                                        <div class="number-input">
                                            <button onclick="this.parentNode.querySelector(',"'input[type=number]'",').stepDown()"></button>
                                            <input min="1" max="'.$fila['Stock'].'" id="stock'.$fila['CodigoProd'].'" value="1" type="number" readonly>
                                            <button onclick="this.parentNode.querySelector(',"'input[type=number]'",').stepUp()" class="plus"></button>
                                        </div>
                                    </h4>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <br><br><br>
                                    <img class="img-responsive" src="assets/img-productos/'.$fila['Imagen'].'">
                                </div>
                                <br><br><br>
                                <div class="col-xs-12 text-center">
                                    <a href="productos" class="btn btn-lg btn-primary"><i class="fa fa-mail-reply"></i>&nbsp;&nbsp;Regresar a la tienda</a> &nbsp;&nbsp;&nbsp; 
                                    <button value="'.$fila['CodigoProd'].'" class="btn btn-lg btn-success botonCarrito"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp; Añadir al carrito</button>
                                </div>
                            ';
                        }
                    ?>
                </div>
            </div>
        </section>
        <?php include './incluir/footer.php'; ?>
    </body>
</html>