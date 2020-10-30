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
                    <li role="presentation" class="active"><a href="#Admins" role="tab" data-toggle="tab">Admin</a></li>
                    <li role="presentation"><a href="#Registros" role="tab" data-toggle="tab">Registros</a></li>
                  ';
                }
                else
                {
                  echo '
                    <li role="presentation" class="active"><a href="#Productos" role="tab" data-toggle="tab">Productos</a></li>
                    <li role="presentation"><a href="#Categorias" role="tab" data-toggle="tab">Categorías</a></li>
                    <li role="presentation"><a href="#Pedidos" role="tab" data-toggle="tab">Pedidos</a></li>
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
                                      <form action="procesos/registrarAdmin.php" method="post" role="form">
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
                                      <form action="procesos/eliminarAdmin.php" method="post" role="form">
                                          <div class="form-group">
                                              <label>Administradores</label>
                                              <select class="form-control" name="name-admin">';
                                                      $adminCon = ejecutarSQL::consultar("select * from administrador where Usuario!='admin'");
                                                      while($AdminD=mysqli_fetch_array($adminCon)){
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
                      <!-- ==================== Fin panel admin =============== -->
                    ';

                    echo '
                      <!-- ==================== Panel registros9 =============== -->
                      <div role="tabpanel" class="tab-pane fade" id="Registros">
                          <div class="row">
                              <div class="col-xs-12">
                                  <br><br>
                                   <div class="panel panel-info">
                                     <div class="panel-heading text-center"><i class="fa fa-book fa-4x"></i><h3>Registro de acciones</h3></div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                          <thead class="">
                                              <tr>
                                                  <th class="text-center">Fecha</th>
                                                  <th class="text-center">Admin</th>
                                                  <th class="text-center">Tabla</th>
                                                  <th class="text-center">Accion</th>
                                              </tr>
                                          </thead>
                                          <tbody>';
                                                $registroc = ejecutarSQL::consultar("select * from registro order by Fecha");
                                                while($registro = mysqli_fetch_array($registroc)){
                                                  echo'
                                                    <div id="registros">
                                                        <tr>
                                                            <td>'.$registro['Fecha'].'</td>
                                                            <td>'.$registro['NombreAdmin'].'</td>
                                                            <td>'.$registro['Tabla'].'</td>
                                                            <td>'.$registro['Accion'].'</td>
                                                        </tr>
                                                    </div>
                                                  ';
                                                }
                                          echo '
                                          </tbody>
                                        </table>
                                    </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- ==================== Fin panel registros =============== -->
                    ';
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
                                  <form role="form" action="procesos/registrarProducto.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                      <label>Código de producto</label>
                                      <input type="text" class="form-control"  placeholder="Código" required maxlength="30" name="prod-cod">
                                    </div>
                                    <div class="form-group">
                                      <label>Nombre de producto</label>
                                      <input type="text" class="form-control"  placeholder="Nombre" required maxlength="30" name="prod-nombre">
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
                                      <input type="text" class="form-control"  placeholder="Marca" required maxlength="30" name="prod-marca">
                                    </div>
                                    <div class="form-group">
                                      <label>Stock</label>
                                      <input type="text" class="form-control"  placeholder="Stock" required maxlength="20" pattern="[0-9]{1,20}" name="prod-stock">
                                    </div>
                                    <div class="form-group">
                                      <label>Imagen de producto</label>
                                      <input type="file" name="img">
                                      <p class="help-block">Formato de imagenes admitido png, jpg, gif, jpeg</p>
                                    </div>
                                      <input type="hidden"  name="admin-name" value="'; echo $_SESSION['nombreAdmin']; echo '">
                                    <p class="text-center"><button type="submit" class="btn btn-primary">Agregar a la tienda</button></p>
                                    <div id="res-form-add-prod" style="width: 100%; text-align: center; margin: 0;"></div>
                                  </form>
                              </div>
                          </div>
                          <div class="col-xs-12 col-sm-6">
                              <br><br>
                              <div id="del-prod-form">
                                  <h2 class="text-danger text-center"><small><i class="fa fa-trash-o"></i></small>&nbsp;&nbsp;Eliminar un producto</h2>
                                   <form action="procesos/eliminarProducto.php" method="post" role="form">
                                       <div class="form-group">
                                           <label>Productos</label>
                                           <select class="form-control" name="prod-cod">';
                                                   $productoc = ejecutarSQL::consultar("select * from producto order by CodigoProd");
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
                                              $productos = ejecutarSQL::consultar("select * from producto order by CodigoProd");
                                              $upr=1;
                                              while($prod=mysqli_fetch_array($productos))
                                              {
                                                  echo '
                                                      <div id="update-product">
                                                        <form method="post" action="procesos/actualizarProducto.php" id="res-update-product-'.$upr.'">
                                                          <tr>
                                                              <td>
                                                                <input class="form-control" type="hidden" name="cod-old-prod" required="" value="'.$prod['CodigoProd'].'">
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
                                                            echo '<select class="form-control" name="prod-categoria">';
                                                                      echo '<option value="'.$codeCat.'">'.$nameCat.'</option>';
                                                                      $categoriac2 = ejecutarSQL::consultar("select * from categoria");
                                                                      while($catec2=mysqli_fetch_array($categoriac2))
                                                                      {
                                                                          if($catec2['CodigoCat']==$codeCat)
                                                                          {
                                                                              
                                                                          }
                                                                          else
                                                                          {
                                                                            echo '<option value="'.$catec2['CodigoCat'].'">'.$catec2['Nombre'].'</option>';  
                                                                          }
                                                                      }
                                                            echo '</select>
                                                              </td>
                                                              <td><input class="form-control" type="text-area" name="precio-prod" required="" value="'.$prod['Precio'].'"></td>
                                                              <td><input class="form-control" type="tel" name="marca-prod" required="" maxlength="20" value="'.$prod['Marca'].'"></td>
                                                              <td><input class="form-control" type="text-area" name="stock-prod" maxlength="30" required="" value="'.$prod['Stock'].'"></td>'; 
                                                             echo '</select>
                                                              <td class="text-center">
                                                                  <button type="submit" class="btn btn-sm btn-primary button-UPR" value="res-update-product-'.$upr.'">Actualizar</button>
                                                                  <div id="res-update-product-'.$upr.'" style="width: 100%; margin:0px; padding:0px;"></div>
                                                              </td>
                                                          </tr>
                                                        </form>
                                                      </div>
                                                      ';
                                                  $upr=$upr+1;
                                              }
                                        echo '
                                        </tbody>
                                    </table>
                                </div>
                              </div>
                          </div>
                      </div>
                      </div>
                      <!-- ==================== Fin panel productos =============== -->
                    ';

                    echo '
                      <!-- ==================== Panel categorias =============== -->
                      <div role="tabpanel" class="tab-pane fade" id="Categorias">
                          <div class="row">
                              <div class="col-xs-12 col-sm-6">
                                  <br><br>
                                  <div id="add-categori">
                                      <h2 class="text-info text-center"><small><i class="fa fa-plus"></i></small>&nbsp;&nbsp;Agregar categoría</h2>
                                      <form action="procesos/registrarCategoria.php" method="post" role="form">
                                          <div class="form-group">
                                              <label>Código</label>
                                              <input class="form-control" type="text" name="categ-cod" placeholder="Código de categoria" maxlength="9" required="">
                                          </div>
                                          <div class="form-group">
                                              <label>Nombre</label>
                                              <input class="form-control" type="text" name="categ-nombre" placeholder="Nombre de categoria" maxlength="30" required="">
                                          </div>
                                          <div class="form-group">
                                              <label>Descripción</label>
                                              <input class="form-control" type="text" name="categ-desc" placeholder="Descripcióne de categoria" required="">
                                          </div>
                                          <p class="text-center"><button type="submit" class="btn btn-primary">Agregar categoría</button></p>
                                          <br>
                                          <div id="res-form-add-categori" style="width: 100%; text-align: center; margin: 0;"></div>
                                      </form>
                                  </div>
                              </div>
                              <div class="col-xs-12 col-sm-6">
                                  <br><br>
                                  <div id="del-categori">
                                      <h2 class="text-danger text-center"><small><i class="fa fa-trash-o"></i></small>&nbsp;&nbsp;Eliminar una categoría</h2>
                                      <form action="procesos/eliminarCategoria.php" method="post" role="form">
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
                                                    $ui=1;
                                                    while($cate=mysqli_fetch_array($categorias))
                                                    {
                                                      echo '
                                                          <div id="update-category">
                                                            <form method="post" action="procesos/actualizarCategoria.php" id="res-update-category-'.$ui.'">
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
                                                          </div>
                                                          ';
                                                      $ui=$ui+1;
                                                    }
                                              echo '
                                              </tbody>
                                          </table>
                                      </div>
                                    </div>
                              </div>
                          </div>
                      </div>
                      <!-- ==================== Fin panel categorias =============== -->
                    ';
                  }

                  echo '
                    <!-- ==================== Panel pedidos =============== -->
                    <div role="tabpanel" class="tab-pane fade" id="Pedidos">
                        <div class="row">
                            <div class="col-xs-12">
                                <br><br>
                                 <div class="panel panel-info">
                                   <div class="panel-heading text-center"><i class="fa fa-refresh fa-2x"></i><h3>Actualizar estado de pedido</h3></div>
                                  <div class="table-responsive">
                                      <table class="table table-bordered">
                                        <thead class="">
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Fecha</th>
                                                <th class="text-center">Cliente</th>
                                                <th class="text-center">Descuento</th>
                                                <th class="text-center">Total</th>
                                                <th class="text-center">Estado</th>
                                                <th class="text-center">Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                                              $pedidoU=  ejecutarSQL::consultar("select * from venta");
                                              $upp=1;
                                              while($peU = mysqli_fetch_array($pedidoU))
                                              {
                                                  echo '
                                                      <div id="update-pedido">
                                                        <form method="post" action="procesos/actualizarPedido.php" id="res-update-pedido-'.$upp.'">
                                                          <tr>
                                                              <td>'.$peU['NumPedido'].'<input type="hidden" name="num-pedido" value="'.$peU['NumPedido'].'"></td>
                                                              <td>'.$peU['Fecha'].'</td>
                                                              <td>';
                                                                  $conUs= ejecutarSQL::consultar("select * from cliente where NIT='".$peU['NIT']."'");
                                                                  while($UsP=mysqli_fetch_array($conUs)){
                                                                      echo $UsP['Nombre'];
                                                                  }
                                                      echo   '</td>
                                                              <td>'.$peU['Descuento'].'%</td>
                                                              <td>'.$peU['TotalPagar'].'</td>
                                                              <td>
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
                                                      echo        '</select>
                                                              </td>
                                                              <td class="text-center">
                                                                  <button type="submit" class="btn btn-sm btn-primary button-UPPE" value="res-update-pedido-'.$upp.'">Actualizar</button>
                                                                  <div id="res-update-pedido-'.$upp.'" style="width: 100%; margin:0px; padding:0px;"></div>
                                                              </td>
                                                          </tr>
                                                        </form>
                                                      </div>
                                                      ';
                                                  $upp=$upp+1;
                                              }
                                        echo '
                                        </tbody>
                                      </table>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ==================== Fin panel pedidos =============== -->
                  ';
                ?>
            </div>
        </div>
    </section>
    <?php include './incluir/footer.php'; ?>
</body>
</html>
