<html>
    <head>
        <title>Admin</title>
        <meta charset="UTF-8">
        <meta http-equiv="Refresh" content="12;url=../configAdmin.php">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/font-awesome.min.css">
        <link rel="stylesheet" href="../css/normalize.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/media.css">
        <link rel="Shortcut Icon" type="image/x-icon" href="../assets/iconos/logo.ico" />
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/autohidingnavbar.min.js"></script>
    </head>
    <body>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-6 col-md-offset-3 text-center">
                        <?php
                            session_start();
                            include '../conexion/configServer.php';
                            include '../conexion/consultaSQL.php';

                            $codProducto = $_POST['prod-cod'];
                            $nombreProducto = $_POST['prod-nombre'];
                            $categoriaProducto = $_POST['prod-categoria'];
                            $precioProducto = $_POST['prod-precio'];
                            $marcaProducto = $_POST['prod-marca'];
                            $stockProducto = $_POST['prod-stock'];
                            $adminProd = $_POST['admin-name'];

                            if(!$codProducto == "" && !$nombreProducto == "" && !$categoriaProducto == "" && !$precioProducto == "" && !$marcaProducto == "" && !$stockProducto == "" && 
                                !$_FILES['img']['name'] == "")
                            {
                                $verificar = ejecutarSQL::consultar("select * from producto where CodigoProd='".$codProducto."'");
                                $verificaltotal = mysqli_num_rows($verificar);
                                if($verificaltotal <= 0)
                                {
                                    if(move_uploaded_file($_FILES['img']['tmp_name'],"../assets/img-productos/".$_FILES['img']['name']))
                                    {
                                        if(consultasSQL::InsertSQL("producto", "CodigoProd, NombreProd, CodigoCat, Precio, Marca, Stock, Imagen, NombreAdmin", "'$codProducto','$nombreProducto','$categoriaProducto','$precioProducto', '$marcaProducto','$stockProducto','".$_FILES['img']['name']."','$adminProd'"))
                                        {
                                            consultasSQL::InsertSQL("registro", "NombreAdmin, Tabla, Accion", "'".$_SESSION['nombreAdmin']."','Producto','Registrar'");

                                            echo '
                                                <img src="../assets/img/correctofull.png" class="center-all-contens">
                                                <br>
                                                <h3>El producto se añadio a la tienda con éxito</h3>
                                                <p class="lead text-cente">
                                                    La pagina se redireccionara automaticamente. Si no es asi haga click en el siguiente boton.<br>
                                                    <a href="../configAdmin" class="btn btn-primary btn-lg">Volver a administración</a>
                                                </p>
                                                <script>
                                                    setTimeout(function(){
                                                    url ="../configAdmin";
                                                    $(location).attr("href",url);
                                                    },5000);
                                                </script>
                                            ';
                                       }
                                       else
                                       {
                                            echo '
                                                <img src="../assets/img/incorrectofull.png" class="center-all-contens">
                                                <br>
                                                <h3>Ha ocurrido un error. Por favor intente nuevamente</h3>
                                                <p class="lead text-cente">
                                                    La pagina se redireccionara automaticamente. Si no es asi haga click en el siguiente boton.<br>
                                                    <a href="../configAdmin" class="btn btn-primary btn-lg">Volver a administración</a>
                                                </p>
                                                <script>
                                                    setTimeout(function(){
                                                    url ="../configAdmin";
                                                    $(location).attr("href",url);
                                                    },5000);
                                                </script>    
                                            ';
                                       }   
                                    }
                                    else
                                    {
                                        echo ' 
                                            <img src="../assets/img/incorrectofull.png" class="center-all-contens">
                                            <br>
                                            <h3>Ha ocurrido un error al cargar la imagen</h3>
                                            <p class="lead text-cente">
                                                La pagina se redireccionara automaticamente. Si no es asi haga click en el siguiente boton.<br>
                                                <a href="../configAdmin" class="btn btn-primary btn-lg">Volver a administración</a>
                                            </p>
                                            <script>
                                                setTimeout(function(){
                                                url ="../configAdmin";
                                                $(location).attr("href",url);
                                                },5000);
                                            </script>
                                        ';
                                    }
                                }
                                else
                                {
                                    echo '
                                        <img src="../assets/img/incorrectofull.png" class="center-all-contens">
                                        <br>
                                        <h3>El Código de producto ya esta registrado.<br>Por favor ingrese otro código de producto</h3>
                                        <p class="lead text-cente">
                                            La pagina se redireccionara automaticamente. Si no es asi haga click en el siguiente boton.<br>
                                            <a href="../configAdmin" class="btn btn-primary btn-lg">Volver a administración</a>
                                        </p>
                                        <script>
                                            setTimeout(function(){
                                            url ="../configAdmin";
                                            $(location).attr("href",url);
                                            },5000);
                                        </script>
                                    ';
                                }
                            }
                            else
                            {
                                echo '
                                    <img src="../assets/img/incorrectofull.png" class="center-all-contens">
                                    <br>
                                    <h3>Error los campos no deben de estar vacíos</h3>
                                    <p class="lead text-cente">
                                        La pagina se redireccionara automaticamente. Si no es asi haga click en el siguiente boton.<br>
                                        <a href="../configAdmin" class="btn btn-primary btn-lg">Volver a administración</a>
                                    </p>
                                    <script>
                                        setTimeout(function(){
                                        url ="../configAdmin";
                                        $(location).attr("href",url);
                                        },5000);
                                    </script>
                                ';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>