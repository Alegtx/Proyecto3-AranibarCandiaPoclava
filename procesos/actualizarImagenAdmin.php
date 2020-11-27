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

                            if(!$_FILES['img-super']['name'] == "")
                            {
                                if(move_uploaded_file($_FILES['img-super']['tmp_name'],"../assets/img-supermercados/".$_FILES['img-super']['name']))
                                {
                                    //Con la fecha en UTC
                                    date_default_timezone_set('UTC');
                                    //Renombrar el archivo con la fecha y hora por delante para que no se repitan los nombres
                                    rename ("../assets/img-supermercados/".$_FILES['img-super']['name'], "../assets/img-supermercados/".date("Y-m-d_H.i.s")."_".$_FILES['img-super']['name']);
                                    if(consultasSQL::UpdateSQL("administrador", "Imagen = '".date("Y-m-d_H.i.s")."_".$_FILES['img-super']['name']."'", "Usuario = '".$_SESSION['nombreAdmin']."'"))
                                    {
                                        consultasSQL::InsertSQL("registro", "NombreAdmin, Tabla, Accion", "'".$_SESSION['nombreAdmin']."','Administrador','Modificar'");

                                        echo '
                                            <img src="../assets/img/correctofull.png" class="center-all-contens">
                                            <br>
                                            <h3>La imagen se cambio exitosamente.</h3>
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
                                    <h3>Error debe haber puesto una imagen.</h3>
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