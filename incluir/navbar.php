<?php 
    session_start(); 
    error_reporting(E_PARSE);
    if(!isset($_SESSION['contador']) && !isset($_SESSION['supermercado'])){
        $_SESSION['contador'] = 0;
        $_SESSION['supermercado'] = "";
    }
?>
<script type="text/javascript">
    $(document).ready(function(){
        //Funcion para mostrar u ocultar la contraseña en el login
        $('#mostrar-ocultar-login').click(function(){
            if($(this).hasClass('fa fa-eye'))
            {
                $('#password-login').removeAttr('type','text');
                $('#mostrar-ocultar-login').addClass('fa-eye-slash').removeClass('fa-eye');
            }
            else
            {
                $('#password-login').attr('type','password');
                $('#mostrar-ocultar-login').addClass('fa-eye').removeClass('fa-eye-slash');
            }
        });
    });
</script>
<section id="container-carrito-compras">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div id="carrito-compras-tienda"></div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <p class="text-center" style="font-size: 80px;">
                    <i class="fa fa-shopping-cart"></i>
                </p>
                <p class="text-center">
                    <a href="pedido.php" class="btn btn-success btn-block"><i class="fa fa-dollar"></i>   Confirmar pedido</a>
                    <a href="procesos/vaciarCarrito.php" class="btn btn-danger btn-block"><i class="fa fa-trash"></i>   Vaciar carrito</a> 
                </p>
            </div>
        </div>
    </div>
</section>
    <nav id="navbar-auto-hidden">
        <div class="row hidden-xs">
            <div class="col-xs-3">
                <figure class="logo-navbar"></figure>
                <p class="text-navbar tittles-pages-logo">Shopon-line</p>
            </div>
            <div class="col-xs-9">
                <div class="contenedor-tabla pull-right">
                    <div class="contenedor-tr">
                        <a href="index" class="table-cell-td">Inicio</a>
                        <a href="productos" class="table-cell-td">Productos</a>
                        <?php
                            if(!$_SESSION['nombreAdmin'] == "")
                            {
                                echo ' 
                                    <a href="nosotros" class="table-cell-td">Nosotros</a>
                                    <a href="configAdmin" class="table-cell-td">Administración</a>
                                    <a href="#" class="table-cell-td carrito-button-nav all-elements-tooltip" data-toggle="tooltip" data-placement="bottom" title="Ver carrito de compras">
                                        <i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-down"></i>
                                    </a>
                                    <a href="#" class="table-cell-td" data-toggle="modal" data-target=".modal-logout">
                                        <i class="fa fa-user"></i>&nbsp;&nbsp;'.$_SESSION['nombreAdmin'].'
                                    </a>
                                 ';
                            }
                            else if(!$_SESSION['nombreUser'] == "")
                            {
                                echo ' 
                                    <a href="nosotros" class="table-cell-td">Nosotros</a>
                                    <a href="pedido" class="table-cell-td">Pedido</a>
                                    <a href="#" class="table-cell-td carrito-button-nav all-elements-tooltip" data-toggle="tooltip" data-placement="bottom" title="Ver carrito de compras">
                                        <i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-down"></i>
                                    </a>
                                    <a href="#" class="table-cell-td" data-toggle="modal" data-target=".modal-logout">
                                        <i class="fa fa-user"></i>&nbsp;&nbsp;'.$_SESSION['nombreUser'].'                                    </a>
                                 ';
                            }
                            else
                            {
                                echo ' 
                                    <a href="nosotros" class="table-cell-td">Nosotros</a>
                                    <a href="registro" class="table-cell-td">Registro</a>
                                    <a href="#" class="table-cell-td carrito-button-nav all-elements-tooltip" data-toggle="tooltip" data-placement="bottom" title="Ver carrito de compras">
                                        <i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-down"></i>
                                    </a>
                                    <a href="#" class="table-cell-td" data-toggle="modal" data-target=".modal-login">
                                        <i class="fa fa-user"></i>&nbsp;&nbsp;Login
                                    </a>
                                 ';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- ==================== Navbar celular =============== -->
        <div class="row visible-xs">
            <div class="col-xs-12">
                <button class="btn btn-default pull-left button-mobile-menu" id="btn-mobile-menu">
                    <i class="fa fa-th-list"></i>&nbsp;&nbsp;Menú
                </button>
                <a href="#" id="button-shopping-cart-xs" class="elements-nav-xs all-elements-tooltip carrito-button-nav" data-toggle="tooltip" data-placement="bottom" title="Ver carrito de compras">
                    <i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-down"></i>
                </a>
                <?php
                    if(!$_SESSION['nombreAdmin'] == "")
                    {
                        echo '
                        <a href="#"  id="button-login-xs" class="elements-nav-xs" data-toggle="modal" data-target=".modal-logout">
                            <i class="fa fa-user"></i>&nbsp; '.$_SESSION['nombreAdmin'].' 
                        </a>';
                    }
                    else if(!$_SESSION['nombreUser'] == "")
                    {
                        echo '
                        <a href="#"  id="button-login-xs" class="elements-nav-xs" data-toggle="modal" data-target=".modal-logout">
                            <i class="fa fa-user"></i>&nbsp; '.$_SESSION['nombreUser'].' 
                        </a>';
                    }
                    else
                    {
                        echo '
                           <a href="#" data-toggle="modal" data-target=".modal-login" id="button-login-xs" class="elements-nav-xs">
                            <i class="fa fa-user"></i>&nbsp; Iniciar Sesión
                            </a> 
                       ';
                    }
                ?>
            </div>
        </div>
        <!-- ==================== Fin navbar celular =============== -->
    </nav>
    <!-- ==================== Modal de login =============== -->
    <div class="modal fade modal-login" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
          <div class="modal-content" id="modal-form-login">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title text-center text-primary" id="myModalLabel">Iniciar sesión en Shopon-line</h4>
                </div>
            <form action="procesos/login.php" method="post" role="form" style="margin: 20px;" class="FormCatElec" data-form="login">
                    <div class="form-group">
                        <label><span class="glyphicon glyphicon-user"></span>&nbsp;Usuario</label>
                        <input type="text" class="form-control" name="usuario-login" placeholder="Escribe tu usuario" required=""/>
                    </div>
                    <div class="form-group">
                        <label><span class="glyphicon glyphicon-lock"></span>&nbsp;Contraseña</label>
                        <div class="input-group">
                            <input id="password-login" type="password" class="form-control" name="clave-login" placeholder="Escribe tu contraseña" required=""/>
                            <div class="input-group-addon">
                                <span id="mostrar-ocultar-login" style="cursor:pointer;" class="fa fa-eye"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm">Iniciar sesión</button>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
                    </div>
                    <div class="ResFormL" style="width: 100%; text-align: center; margin: 0;"></div>
              </form>
          </div>
      </div>
    </div>
    <!-- ==================== Fin modal de login =============== -->

    <!-- ==================== Menu celuar =============== -->
    <div id="mobile-menu-list" class="hidden-sm hidden-md hidden-lg">
        <br>
        <h3 class="text-center tittles-pages-logo">Shopon-line</h3>
        <button class="btn btn-default button-mobile-menu" id="button-close-mobile-menu">
        <i class="fa fa-times"></i>
        </button>
        <br><br>
        <ul class="list-unstyled text-center">
            <li><a href="indexp">Inicio</a></li>
            <li><a href="productos">Productos</a></li>
            <?php 
                if(!$_SESSION['nombreAdmin'] == "")
                {
                    echo '<li><a href="configAdmin">Administración</a></li>';
                }
                elseif(!$_SESSION['nombreUser'] == "")
                {
                    echo '<li><a href="pedido">Pedido</a></li>';
                }
                else
                {
                    echo '<li><a href="registro">Registro</a></li>';
                }
            ?>
        </ul>
    </div>
    <!-- ==================== Fin menu celular =============== -->

    <!-- ==================== Modal de carrito =============== -->
    <div class="modal fade modal-carrito" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="padding: 20px;">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <br>
            <p class="text-center"><i class="fa fa-shopping-cart fa-5x"></i></p>
            <p class="text-center">El producto se añadio al carrito correctamente.</p>
            <p class="text-center"><button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Aceptar</button></p>
        </div>
      </div>
    </div>
    <!-- ==================== Fin modal de carrito =============== -->
   
    <!-- ==================== Modal de logout =============== -->
    <div class="modal fade modal-logout" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="padding: 20px;">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <br>
            <p class="text-center">¿Quieres cerrar la sesión?</p>
            <p class="text-center"><i class="fa fa-exclamation-triangle fa-5x"></i></p>
            <p class="text-center">
                <a href="procesos/logout.php" class="btn btn-primary btn-sm">Cerrar la sesión</a>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
            </p>
        </div>
      </div>
    </div>
    <!-- ==================== Fin modal de logout =============== -->