<?php
  include './conexion/configServer.php';
  include './conexion/consultaSQL.php';
  include './procesos/validarSesion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Admin</title>
  <?php include './incluir/link.php'; ?>
  <script type="text/javascript" src="js/admin.js"></script>
</head>
<body id="container-page-configAdmin">
  <?php include './incluir/navbar.php'; ?>
  <section id="prove-product-cat-config">
    <div class="container">
      <div class="page-header">
        <h1>Panel de administración <small class="tittles-pages-logo">Shopon-line</small></h1>
      </div>
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <?php
          if($_SESSION['nombreAdmin'] == 'admin')
          {
            echo '
              <li role="presentation" class="active"><a href="#Admins" role="tab" data-toggle="tab">Admins</a></li>
              <li role="presentation"><a href="#Registros" role="tab" data-toggle="tab">Registros</a></li>
            ';
          }
          else
          {
            echo '
              <li role="presentation" class="active"><a href="#Productos" role="tab" data-toggle="tab">Productos</a></li>
              <li role="presentation"><a href="#Categorias" role="tab" data-toggle="tab">Categorías</a></li>
              <li role="presentation"><a href="#Pedidos" role="tab" data-toggle="tab">Pedidos</a></li>
              <li role="presentation"><a href="#Info" role="tab" data-toggle="tab">Info</a></li>
            ';
          }
        ?>
      </ul>
      <div class="tab-content">                
        <?php
          if($_SESSION['nombreAdmin'] == 'admin')
          {
            echo '
              <!-- ==================== Panel admin =============== -->
              <div role="tabpanel" class="tab-pane fade in active" id="Admins">
                <div class="row">
                  <div class="col-xs-12 col-sm-6">
                    <br><br>
                    <div id="add-admin">
                      <h2 class="text-info text-center"><small><i class="fa fa-plus"></i></small>&nbsp;&nbsp;Agregar administrador</h2>
                      <form action="procesos/registrarAdmin" method="post" role="form">
                        <div class="form-group">
                          <label>Nombre</label>
                          <input class="form-control" type="text" name="admin-user" placeholder="Nombre" maxlength="9" pattern="[a-zA-Z]{4,9}" required="">
                        </div>
                        <div class="form-group">
                          <label>Contraseña</label>
                          <input class="form-control" type="password" name="admin-pass" placeholder="Contraseña" required="">
                        </div>
                        <p class="text-center"><button type="submit" class="btn btn-primary">Agregar administrador</button></p>
                        <br>
                        <div id="res-form-add-admin" style="width: 100%; text-align: center; margin: 0;"></div>
                      </form>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    <br><br>
                    <div id="del-admin">
                      <h2 class="text-danger text-center"><small><i class="fa fa-trash-o"></i></small>&nbsp;&nbsp;Eliminar administrador</h2>
                      <form action="procesos/eliminarAdmin" method="post" role="form">
                        <div class="form-group">
                          <label>Administradores</label>
                          <select class="form-control" name="name-admin">';
                            $adminCon = ejecutarSQL::consultar("select * from administrador where Usuario!='admin'");
                            while($AdminD = mysqli_fetch_array($adminCon))
                            {
                              echo '<option value="'.$AdminD['Usuario'].'">'.$AdminD['Usuario'].'</option>';
                            }
                          echo '
                          </select>
                        </div>
                        <p class="text-center"><button type="submit" class="btn btn-danger">Eliminar administrador</button></p>
                        <br>
                        <div id="res-form-del-admin" style="width: 100%; text-align: center; margin: 0;"></div>
                      </form>
                    </div>
                  </div>
                  <div class="col-xs-12"></div>
                </div>
              </div>
              <!-- ==================== Fin panel admin =============== -->';

            echo '
              <!-- ==================== Panel registros =============== -->
              <div role="tabpanel" class="tab-pane fade" id="Registros">
                <div class="row">
                  <div class="col-xs-12">
                    <br><br>
                    <div class="panel panel-info">
                      <div class="panel-heading text-center"><i class="fa fa-book fa-4x"></i><h3>Registro de acciones</h3></div>
                      <div class="table-responsive">
                        <table class="table table-bordered text-center">
                          <thead class="">
                            <tr>
                              <th class="text-center">Fecha</th>
                              <th class="text-center">Admin</th>
                              <th class="text-center">Tabla</th>
                              <th class="text-center">Accion</th>
                            </tr>
                          </thead>
                          <tbody>';
                            $registroc = ejecutarSQL::consultar("select * from registro order by Fecha desc");
                            while($registro = mysqli_fetch_array($registroc))
                            {
                              echo'
                                <div id="registros">
                                    <tr>
                                        <td>'.$registro['Fecha'].'</td>
                                        <td>'.$registro['NombreAdmin'].'</td>
                                        <td>'.$registro['Tabla'].'</td>
                                        <td>'.$registro['Accion'].'</td>
                                    </tr>
                                </div>';
                            }
                            echo '
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- ==================== Fin panel registros =============== -->';
          }
          else
          {
            echo '
              <!-- ==================== Panel productos =============== -->
              <div role="tabpanel" class="tab-pane fade in active" id="Productos">
                <div class="row">
                  <div class="col-xs-12 col-sm-6">
                    <br><br>
                    <div id="add-prod">
                      <h2 class="text-primary text-center"><small><i class="fa fa-plus"></i></small>&nbsp;&nbsp;Agregar un producto nuevo</h2>
                      <form id="form-add-prod" role="form" action="procesos/registrarProducto" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                          <label>Código de producto</label>
                          <input type="text" class="form-control"  placeholder="Código" required maxlength="30" name="prod-cod" onChange="ValidarEspacios(event, '."'botonRegistroProducto'".')">
                          <div id="error-prod-cod"></div>
                        </div>
                        <div class="form-group">
                          <label>Nombre de producto</label>
                          <input type="text" class="form-control"  placeholder="Nombre" required maxlength="30" name="prod-nombre" onChange="ValidarEspacios(event, '."'botonRegistroProducto'".')">
                          <div id="error-prod-nombre"></div>
                        </div>
                        <div class="form-group">
                          <label>Categoría</label>
                            <select class="form-control" name="prod-categoria">';
                              $categoriac = ejecutarSQL::consultar("select * from categoria");
                              while($catec = mysqli_fetch_array($categoriac))
                              {
                                echo '<option value="'.$catec['CodigoCat'].'">'.$catec['Nombre'].'</option>';
                              }
                            echo '
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Precio</label>
                          <input type="text" class="form-control"  placeholder="Precio" required maxlength="20" pattern="[0-9.]{1,20}" name="prod-precio">
                        </div>
                        <div class="form-group">
                          <label>Marca</label>
                          <input type="text" class="form-control"  placeholder="Marca" required maxlength="30" name="prod-marca" onChange="ValidarEspacios(event, '."'botonRegistroProducto'".')">
                          <div id="error-prod-marca"></div>
                        </div>
                        <div class="form-group">
                          <label>Stock</label>
                          <input type="text" class="form-control"  placeholder="Stock" required maxlength="20" pattern="[0-9]{1,20}" name="prod-stock">
                          <div id="error-prod-stock"></div>
                        </div>
                        <div class="form-group">
                          <label>Imagen de producto</label>
                          <input type="file" name="img" accept="image/x-png,image/jpg,image/gif,image/jpeg">
                          <p class="help-block">Formato de imagenes admitido png, jpg, gif, jpeg.</p>
                        </div>
                        <input type="hidden"  name="admin-name" value="'.$_SESSION['nombreAdmin'].'">
                        <p class="text-center"><button type="submit" id="botonRegistroProducto" class="btn btn-primary">Agregar a la tienda</button></p>
                        <div id="res-form-add-prod" style="width: 100%; text-align: center; margin: 0;"></div>
                        <div id="errores-form" class="errores-form"></div>
                      </form>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    <br><br>
                    <div id="del-prod-form">
                      <h2 class="text-danger text-center"><small><i class="fa fa-trash-o"></i></small>&nbsp;&nbsp;Eliminar un producto</h2>
                      <form action="procesos/eliminarProducto" method="post" role="form">
                        <div class="form-group">
                          <label>Productos</label>
                          <select class="form-control" name="prod-cod">';
                            $productoc = ejecutarSQL::consultar("select * from producto where NombreAdmin='".$_SESSION['nombreAdmin']."' order by CodigoProd");
                            while($prodc = mysqli_fetch_array($productoc))
                            {
                              echo '<option value="'.$prodc['CodigoProd'].'">'.$prodc['CodigoProd'].' - '.$prodc['NombreProd'].' - '.$prodc['Marca'].'</option>';
                            }
                            echo '
                          </select>
                        </div>
                        <p class="text-center"><button type="submit" class="btn btn-danger">Eliminar</button></p>
                        <br>
                        <div id="res-form-del-prod" style="width: 100%; text-align: center; margin: 0;"></div>
                      </form>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <br><br>
                    <div class="panel panel-info">
                      <div class="panel-heading text-center"><i class="fa fa-refresh fa-2x"></i><h3>Actualizar datos de producto</h3></div>
                      <div class="table-responsive">
                        <table class="table table-bordered">
                          <thead class="">
                            <tr>
                              <th class="text-center">Código</th>
                              <th class="text-center">Nombre</th>
                              <th class="text-center">Categoría</th>
                              <th class="text-center">Precio</th>
                              <th class="text-center">Marca</th>
                              <th class="text-center">Unidades</th>
                              <th class="text-center">Opciones</th>
                            </tr>
                          </thead>
                          <tbody>';
                            $productos = ejecutarSQL::consultar("select * from producto where NombreAdmin='".$_SESSION['nombreAdmin']."' order by CodigoProd");
                            $upr = 1;
                            while($prod = mysqli_fetch_array($productos))
                            {
                              echo '
                                <div id="update-product">
                                  <form method="post" action="procesos/actualizarProducto" id="res-update-product-'.$upr.'">
                                    <tr>
                                      <td>
                                        <input class="form-control" type="hidden" readonly name="cod-old-prod" required="" value="'.$prod['CodigoProd'].'">
                                        <input class="form-control" type="text" name="cod-prod" maxlength="30" required="" value="'.$prod['CodigoProd'].'">
                                      </td>
                                      <td><input class="form-control" type="text" name="prod-nombre" maxlength="30" required="" value="'.$prod['NombreProd'].'"></td>
                                      <td>';
                                        $categoriac3 = ejecutarSQL::consultar("select * from categoria where CodigoCat='".$prod['CodigoCat']."'");
                                        while($catec3 = mysqli_fetch_array($categoriac3))
                                        {
                                          $codeCat = $catec3['CodigoCat'];
                                          $nameCat = $catec3['Nombre'];
                                        }
                                        echo '
                                          <select class="form-control" name="prod-categoria">
                                            <option value="'.$codeCat.'">'.$nameCat.'</option>';
                                            $categoriac2 = ejecutarSQL::consultar("select * from categoria");
                                            while($catec2 = mysqli_fetch_array($categoriac2))
                                            {
                                              if($catec2['CodigoCat'] == $codeCat)
                                              {
                                                          
                                              }
                                              else
                                              {
                                                echo '<option value="'.$catec2['CodigoCat'].'">'.$catec2['Nombre'].'</option>';  
                                              }
                                            }
                                        echo '
                                          </select>
                                      </td>
                                      <td><input class="form-control" type="text-area" name="precio-prod" required="" value="'.$prod['Precio'].'"></td>
                                      <td><input class="form-control" type="tel" name="marca-prod" required="" maxlength="20" value="'.$prod['Marca'].'"></td>
                                      <td><input class="form-control" type="text-area" name="stock-prod" maxlength="30" required="" value="'.$prod['Stock'].'"></td>'; 
                                      echo '
                                      <td class="text-center" width="11%">
                                        <button type="submit" class="btn btn-sm btn-primary button-UPR" value="res-update-product-'.$upr.'">Actualizar</button>
                                        <div onClick="updateImagenProducto('."'".$prod['CodigoProd']."','".$prod['NombreProd']."'".')"
                                          class="btn btn-sm btn-info"><i class="fa fa-file-image-o"></i></div>
                                        <div id="res-update-product-'.$upr.'" style="width: 100%; margin:0px; padding:0px;"></div>
                                      </td>
                                    </tr>
                                  </form>
                                </div>';
                              $upr = $upr + 1;
                            }
                            echo '
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- ==================== Fin panel productos =============== -->';

            echo '
              <!-- ==================== Panel categorias =============== -->
              <div role="tabpanel" class="tab-pane fade" id="Categorias">
                <div class="row">
                  <div class="col-xs-12 col-sm-6">
                    <br><br>
                    <div id="add-categori">
                      <h2 class="text-info text-center"><small><i class="fa fa-plus"></i></small>&nbsp;&nbsp;Agregar categoría</h2>
                      <form action="procesos/registrarCategoria" method="post" role="form">
                        <div class="form-group">
                          <label>Código</label>
                          <input class="form-control" type="text" name="categ-cod" placeholder="Código de categoria" maxlength="9" required="" onChange="ValidarEspacios(event, '."'botonRegistroCategoria'".')">
                          <div id="error-categ-cod"></div>
                        </div>
                        <div class="form-group">
                          <label>Nombre</label>
                          <input class="form-control" type="text" name="categ-nombre" placeholder="Nombre de categoria" maxlength="30" required="" onChange="ValidarEspacios(event, '."'botonRegistroCategoria'".')">
                          <div id="error-categ-nombre"></div>
                        </div>
                        <div class="form-group">
                          <label>Descripción</label>
                          <input class="form-control" type="text" name="categ-desc" placeholder="Descripción de categoria" required="" onChange="ValidarEspacios(event, '."'botonRegistroCategoria'".')">
                          <div id="error-categ-desc"></div>
                        </div>
                        <p class="text-center"><button type="submit" id="botonRegistroCategoria" class="btn btn-primary">Agregar categoría</button></p>
                        <br>
                        <div id="res-form-add-categori" style="width: 100%; text-align: center; margin: 0;"></div>
                      </form>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    <br><br>
                    <div id="del-categori">
                      <h2 class="text-danger text-center"><small><i class="fa fa-trash-o"></i></small>&nbsp;&nbsp;Eliminar una categoría</h2>
                      <form action="procesos/eliminarCategoria" method="post" role="form">
                        <div class="form-group">
                          <label>Categorías</label>
                          <select class="form-control" name="categ-cod">';
                            $categoriav =  ejecutarSQL::consultar("select * from categoria");
                            while($categv = mysqli_fetch_array($categoriav))
                            {
                              echo '<option value="'.$categv['CodigoCat'].'">'.$categv['CodigoCat'].' - '.$categv['Nombre'].'</option>';
                            }
                            echo '
                          </select>
                        </div>
                        <p class="text-center"><button type="submit" class="btn btn-danger">Eliminar categoría</button></p>
                        <br>
                        <div id="res-form-del-cat" style="width: 100%; text-align: center; margin: 0;"></div>
                      </form>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <br><br>
                    <div class="panel panel-info">
                      <div class="panel-heading text-center"><i class="fa fa-refresh fa-2x"></i><h3>Actualizar categoría</h3></div>
                      <div class="table-responsive">
                        <table class="table table-bordered">
                          <thead class="">
                            <tr>
                              <th class="text-center">Código</th>
                              <th class="text-center">Nombre</th>
                              <th class="text-center">Descripción</th>
                              <th class="text-center">Opciones</th>
                            </tr>
                          </thead>
                          <tbody>';
                            $categorias = ejecutarSQL::consultar("select * from categoria");
                            $ui = 1;
                            while($cate = mysqli_fetch_array($categorias))
                            {
                              echo '
                                <div id="update-category">
                                  <form method="post" action="procesos/actualizarCategoria" id="res-update-category-'.$ui.'">
                                    <tr>
                                      <td>
                                        <input class="form-control" type="hidden" name="categ-cod-old" maxlength="9" required="" value="'.$cate['CodigoCat'].'">
                                        <input class="form-control" type="text" name="categ-cod" maxlength="9" required="" value="'.$cate['CodigoCat'].'">
                                      </td>
                                      <td><input class="form-control" type="text" name="categ-nombre" maxlength="30" required="" value="'.$cate['Nombre'].'"></td>
                                      <td><input class="form-control" type="text-area" name="categ-desc" required="" value="'.$cate['Descripcion'].'"></td>
                                      <td class="text-center">
                                        <button type="submit" class="btn btn-sm btn-primary button-UC" value="res-update-category-'.$ui.'">Actualizar</button>
                                        <div id="res-update-category-'.$ui.'" style="width: 100%; margin:0px; padding:0px;"></div>
                                      </td>
                                    </tr>
                                  </form>
                                </div>';
                              $ui = $ui + 1;
                            }
                          echo '
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- ==================== Fin panel categorias =============== -->';

            echo '
              <!-- ==================== Panel pedidos =============== -->
              <div role="tabpanel" class="tab-pane fade" id="Pedidos">
                <div class="row">
                  <div class="col-xs-12">
                    <br><br>
                    <div class="panel panel-info">
                      <div class="panel-heading text-center">
                        <i class="fa fa-refresh fa-2x"></i>
                        <h3>Actualizar estado de pedido</h3>
                        <p class="help-block">Una vez se actualize el estado del pedido no se podra volver a modificar.</p>
                      </div>
                      <div class="table-responsive">
                        <table class="table table-bordered text-center">
                          <thead class="">
                            <tr>
                              <th class="text-center">#</th>
                              <th class="text-center">Fecha</th>
                              <th class="text-center">Cliente</th>
                              <th class="text-center">Total</th>
                              <th class="text-center">Estado</th>
                              <th class="text-center">Fecha de entrega</th>
                              <th class="text-center">Fecha de recogo</th>
                              <th class="text-center">Opciones</th>
                            </tr>
                          </thead>
                          <tbody>';
                            $pedidoU = ejecutarSQL::consultar("select * from venta where NombreAdmin='".$_SESSION['nombreAdmin']."' order by Fecha desc");
                            $upp = 1;
                            while($peU = mysqli_fetch_array($pedidoU))
                            {
                              echo '
                                  <div id="update-pedido">
                                    <form method="post" action="procesos/actualizarPedido" id="res-update-pedido-'.$upp.'">
                                      <tr>
                                        <td>'.$peU['NumPedido'].'<input type="hidden" name="num-pedido" value="'.$peU['NumPedido'].'"></td>
                                        <td>'.$peU['Fecha'].'</td>
                                        <td>';
                                        $conUs = ejecutarSQL::consultar("select * from cliente where NIT='".$peU['NIT']."'");
                                        while($UsP = mysqli_fetch_array($conUs))
                                        {
                                          echo $UsP['Nombre']." ".$UsP['Apellidos'];
                                        }
                                        echo '
                                        </td>
                                        <td>'.$peU['TotalPagar'].' Bs.</td>
                                        <td>';
                                          if($peU['Estado'] != 'Pendiente')
                                          {
                                            echo '<input type="text" class="form-control" readonly value="'.$peU['Estado'].'"></button>';
                                          }
                                          else
                                          {
                                            echo '
                                            <select class="form-control" name="pedido-status">';
                                            if($peU['Estado'] == "Pendiente")
                                            {
                                              echo '<option value="Pendiente">Pendiente</option>'; 
                                              echo '<option value="Entregado">Entregado</option>'; 
                                              echo '<option value="Cancelado">Cancelado</option>';
                                            }
                                            if($peU['Estado'] == "Entregado")
                                            {
                                              echo '<option value="Entregado">Entregado</option>';
                                              echo '<option value="Pendiente">Pendiente</option>';
                                              echo '<option value="Cancelado">Cancelado</option>'; 
                                            }
                                            if($peU['Estado'] == "Cancelado")
                                            {
                                              echo '<option value="Cancelado">Cancelado</option>';
                                              echo '<option value="Entregado">Entregado</option>';
                                              echo '<option value="Pendiente">Pendiente</option>';   
                                            }
                                            echo '</select>';
                                          }
                                        echo '
                                        </td>
                                        <td>'.$peU['FechaEntrega'].'</td>
                                        <td>'.$peU['FechaRecogo'].'</td>
                                        <td class="text-center">
                                          <div onClick="verDetallePedido('."'".$peU['NumPedido']."'".')"
                                          class="btn btn-sm btn-info">Detalle del pedido</div>
                                          <button type="submit" class="btn btn-sm btn-primary button-UPPE" value="res-update-pedido-'.$upp.'">Actualizar</button>
                                          <div id="res-update-pedido-'.$upp.'" style="width: 100%; margin:0px; padding:0px;"></div>
                                        </td>
                                      </tr>
                                    </form>
                                  </div>';
                              $upp = $upp + 1;
                            }
                            echo '
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- ==================== Fin panel pedidos =============== -->';

              echo '
              <!-- ==================== Panel info =============== -->
              <div role="tabpanel" class="tab-pane fade" id="Info">
                <div class="container text-center">
                  <div class="page-header">
                    <h1>Imagen de presentacion</h1>
                  </div>
                  <div class="row">';
                    $consulta= ejecutarSQL::consultar("select * from administrador where Usuario = '".$_SESSION['nombreAdmin']."'");
                    $admins = mysqli_num_rows($consulta);
                    while($fila=mysqli_fetch_array($consulta))
                    {
                      echo '
                        <div class="col-xs-12 col-sm-6 col-md-5">
                          <h2><b><p class="text-center">Antes</p></b></h2>
                          <font color="red">
                            <i class="fa fa-exclamation-triangle">
                              <p>ADVERTENCIA:</p>
                              <p>Una vez cambie su imagen no se podra recuperar la imagen anterior.</p>
                            </i>
                          </font>
                          <div class="thumbnail">
                            <h3><b><p class="text-center">'.$fila['Usuario'].'</p></b></h3> 
                            <img src="assets/img-supermercados/'.$fila['Imagen'].'">
                          </div>
                          
                        </div>

                        <div class="col-xs-12 col-sm-3 col-md-2 align-middle">
                          <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                          <h1><i class="fa fa-chevron-right"></i></h1>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-5">
                          <h2><b><p class="text-center">Despues</p></b></h2>
                          <form role="form" action="procesos/actualizarImagenAdmin" method="post" enctype="multipart/form-data" id="upload-img">
                            <div class="form-group">
                              <input type="file" id="img-super" name="img-super" accept="image/x-png,image/jpg,image/gif,image/jpeg">
                              <p class="help-block">Formato de imagenes admitido png, jpg, gif, jpeg.</p>
                            </div>
                            <div class="thumbnail">
                              <h3><b><p class="text-center">'.$fila['Usuario'].'</p></b></h3> 
                              <img id="img-new" src="assets/img-supermercados/'.$fila['Imagen'].'">
                            </div>
                            <p class="text-center"><button type="submit" class="btn btn-primary">Cambiar imagen</button></p>
                          </form>
                        </div>
                        ';
                    } 
                  echo '
                  </div>
                </div>
              </div>
              <!-- ==================== Fin panel info =============== -->';           
          }
        ?>
      </div>
    </div>
  </section>

  <!-- ==================== Modal de actualizar imagen =============== -->
  <div class="modal fade" id="modal-imagen" role="dialog">
    <div class="modal-dialog" role="document"> 
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><b>Cambia la imagen del producto</b></h5>
        </div>
        <div class="modal-body">
          <div id="conte-modal-img">
            <div class="modal-text">
              <form role="form" action="procesos/actualizarImagenProducto" method="post" enctype="multipart/form-data">
                <div id="codigo-nombre"></div>
                <div class="form-group">
                  <b>Nueva imagen de tu producto</b>
                  <input type="file" id="img-prod" name="img-prod" accept="image/x-png,image/jpg,image/gif,image/jpeg">
                  <p class="help-block">Formato de imagenes admitido png, jpg, gif, jpeg.</p>
                  <input type="hidden" readonly id="cod-prod-img" name="cod-prod-img" value="">
                </div>
                <p class="text-center"><button type="submit" class="btn btn-primary">Cambiar imagen</button></p>
              </form>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
   <!-- ==================== Fin modal de actualizar imagen =============== -->

   <!-- ==================== Modal de motivo de cancelacion =============== -->
  <div class="modal fade" id="modal-cancelar" role="dialog">
    <div class="modal-dialog" role="document"> 
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><b>Motivo de cancelacion</b></h5>
        </div>
        <div class="modal-body">
          <div id="conte-modal-cancelar">
            <div class="modal-text">
              <div id="cancel-pedido">
                <form role="form" action="procesos/actualizarPedido" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <div id="cancelar-descripcion"></div>
                    <textarea id="motivo-cancelacion" name="motivo-cancelacion" class="form-control" rows="2" cols="50" maxlength="100"></textarea>
                    <p class="help-block">(Max. 100 caracteres).</p>
                    <input type="hidden" readonly id="cod-pedido" name="cod-pedido" value="">
                    <input type="hidden" readonly id="estado-pedido" name="estado-pedido" value="">
                  </div>
                  <p class="text-center"><button type="submit" class="btn btn-danger">Cancelar pedido</button></p>
                  <div id="res-form-cancel-pedido" style="width: 100%; text-align: center; margin: 0;"></div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
   <!-- ==================== Fin modal de motivo de cancelacion =============== -->
  <?php include './incluir/footer.php'; ?>
  <script type="text/javascript" src="js/previewImage.js"></script>
</body>
</html>
