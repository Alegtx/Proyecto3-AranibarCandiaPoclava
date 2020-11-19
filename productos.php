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
  <body id="container-inlcuir-product">
    <?php include './incluir/navbar.php'; ?>
    <section id="store">
      <br>
      <div class="container">
        <div class="page-header">
          <h1>Tienda <small class="tittles-pages-logo">Shopon-line</small></h1>
        </div>
        <br><br>
        <div class="row">
          <div class="col-xs-12">
            <ul id="store-links" class="nav nav-tabs" role="tablist">
              <li role="presentation"><a href="#all-product" role="tab" data-toggle="tab" aria-controls="all-product" aria-expanded="false">Todos los productos</a></li>
              <!-- ==================== Lista categorias =============== -->
              <li role="presentation" class="dropdown active">
                <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown" aria-controls="myTabDrop1-contents" aria-expanded="false">Categorías <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">
                  <?php
                    $categorias =  ejecutarSQL::consultar("select * from categoria");
                    while($cate = mysqli_fetch_array($categorias))
                    {
                      echo '
                        <li>
                          <a href="#'.$cate['CodigoCat'].'" tabindex="-1" role="tab" id="'.$cate['CodigoCat'].'-tab" data-toggle="tab" aria-controls="'.$cate['CodigoCat'].'" aria-expanded="false">'.$cate['Nombre'].'
                          </a>
                        </li>';
                    }
                  ?>
                </ul>
              </li>
              <!-- ==================== Lista supermercados =============== -->
              <li role="presentation" class="dropdown">
                <a href="#" id="myTabDrop2" class="dropdown-toggle" data-toggle="dropdown" aria-controls="myTabDrop2-contents" aria-expanded="false">Supermercados <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop2" id="myTabDrop2-contents">
                  <?php
                    $adminc =  ejecutarSQL::consultar("select * from administrador where Usuario!='admin'");
                    while($admin = mysqli_fetch_array($adminc))
                    {
                      echo '
                          <li>
                              <a href="#'.$admin['Usuario'].'" tabindex="-1" role="tab" id="'.$admin['Usuario'].'-tab" data-toggle="tab" aria-controls="'.$admin['Usuario'].'" aria-expanded="false">'.$admin['Usuario'].'
                              </a>
                          </li>';
                    }
                  ?>
                </ul>
              </li>
            </ul>
            <!-- ==================== Contenedor de todos los productos =============== -->
            <div id="myTabContent" class="tab-content">
              <div role="tabpanel" class="tab-pane fade" id="all-product" aria-labelledby="all-product-tab">
                <br><br>
                <div class="row">
                  <?php
                      $consulta =  ejecutarSQL::consultar("select * from producto where Stock > 0");
                      $totalproductos = mysqli_num_rows($consulta);
                      if($totalproductos > 0)
                      {
                        while($fila = mysqli_fetch_array($consulta))
                        {
                          echo '
                            <div class="col-xs-12 col-sm-6 col-md-4">
                              <div class="thumbnail">
                                <img width="300p" height="300p" src="assets/img-productos/'.$fila['Imagen'].'">
                                <div class="caption">
                                  <h3>'.$fila['NombreProd'].'</h3>
                                  <p>'.$fila['Marca'].'</p>
                                  <p>'.$fila['Precio'].' Bs.</p>
                                  <p><b>'.$fila['NombreAdmin'].'</b></p>
                                  <p>
                                    <div class="number-input">
                                      <button onclick="this.parentNode.querySelector(',"'input[type=number]'",').stepDown()"></button>
                                      <input min="1" max="'.$fila['Stock'].'" id="stock'.$fila['CodigoProd'].'" value="1" type="number" readonly>
                                      <button onclick="this.parentNode.querySelector(',"'input[type=number]'",').stepUp()" class="plus"></button>
                                    </div>
                                  </p>
                                  <p class="text-center">
                                    <a href="infoProducto?CodigoProd='.$fila['CodigoProd'].'" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Detalles</a>&nbsp;&nbsp;
                                    <button value="'.$fila['CodigoProd'].'" class="btn btn-success btn-sm botonCarrito"><i class="fa fa-shopping-cart"></i>&nbsp; Añadir</button>
                                  </p>
                                </div>
                              </div>
                            </div>';
                        }   
                      }
                      else
                      {
                          echo '<h2>No hay productos en esta categoria</h2>';
                      }  
                  ?>
                </div>
              </div>
              <!-- ==================== Fin del contenedor de todos los productos =============== -->

              <!-- ==================== Contenedores de categorias =============== -->
              <?php
                $consultar_categorias = ejecutarSQL::consultar("select * from categoria");
                while($categ = mysqli_fetch_array($consultar_categorias))
                {
                  echo '
                    <div role="tabpanel" class="tab-pane fade active in" id="'.$categ['CodigoCat'].'" aria-labelledby="'.$categ['CodigoCat'].'-tab"><br>';
                  $consultar_productos = ejecutarSQL::consultar("select * from producto where CodigoCat='".$categ['CodigoCat']."' and Stock > 0");
                  $totalprod = mysqli_num_rows($consultar_productos);
                  if($totalprod > 0)
                  {
                    while($prod = mysqli_fetch_array($consultar_productos))
                    {
                      echo '
                        <div class="col-xs-12 col-sm-6 col-md-4">
                          <div class="thumbnail">
                            <img src="assets/img-productos/'.$prod['Imagen'].'">
                            <div class="caption">
                              <h3>'.$prod['NombreProd'].'</h3>
                              <p>'.$prod['Marca'].'</p>
                              <p>'.$prod['Precio'].' Bs.</p>
                              <p><b>'.$prod['NombreAdmin'].'</b></p>
                              <p>
                                <div class="number-input">
                                  <button onclick="this.parentNode.querySelector(',"'input[type=number]'",').stepDown()"></button>
                                  <input min="1" max="'.$fila['Stock'].'" id="stock'.$fila['CodigoProd'].'" value="1" type="number" readonly>
                                  <button onclick="this.parentNode.querySelector(',"'input[type=number]'",').stepUp()" class="plus"></button>
                                </div>
                              </p>
                              <p class="text-center">
                                  <a href="infoProducto.php?CodigoProd='.$prod['CodigoProd'].'" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Detalles</a>&nbsp;&nbsp;
                                  <button value="'.$prod['CodigoProd'].'" class="btn btn-success btn-sm botonCarrito"><i class="fa fa-shopping-cart"></i>&nbsp; Añadir</button>
                              </p>
                            </div>
                          </div>
                        </div>';    
                    } 
                  }
                  else
                  {
                     echo '<h2>No hay productos en esta categoría</h2>'; 
                  }
                  echo '</div>'; 
                }
              //<!-- ==================== Fin contenedores de categorias =============== -->

              //<!-- ==================== Contenedores de supermercados =============== -->
              
                $consultar_supermercado = ejecutarSQL::consultar("select * from administrador");
                while($super = mysqli_fetch_array($consultar_supermercado))
                {
                  echo '
                    <div role="tabpanel" class="tab-pane fade active in" id="'.$super['Usuario'].'" aria-labelledby="'.$super['Usuario'].'-tab"><br>';
                      $consultar_productos = ejecutarSQL::consultar("select * from producto where NombreAdmin='".$super['Usuario']."' and Stock > 0");
                      $totalprod = mysqli_num_rows($consultar_productos);
                      if($totalprod > 0)
                      {
                        while($prod = mysqli_fetch_array($consultar_productos))
                        {
                          echo '
                            <div class="col-xs-12 col-sm-6 col-md-4">
                              <div class="thumbnail">
                                <img src="assets/img-productos/'.$prod['Imagen'].'">
                                <div class="caption">
                                  <h3>'.$prod['NombreProd'].'</h3>
                                  <p>'.$prod['Marca'].'</p>
                                  <p>'.$prod['Precio'].' Bs.</p>
                                  <p><b>'.$prod['NombreAdmin'].'</b></p>
                                  <p>
                                    <div class="number-input">
                                      <button onclick="this.parentNode.querySelector(',"'input[type=number]'",').stepDown()"></button>
                                      <input min="1" max="'.$fila['Stock'].'" id="stock'.$fila['CodigoProd'].'" value="1" type="number" readonly>
                                      <button onclick="this.parentNode.querySelector(',"'input[type=number]'",').stepUp()" class="plus"></button>
                                    </div>
                                  </p>
                                  <p class="text-center">
                                    <a href="infoProducto.php?CodigoProd='.$prod['CodigoProd'].'" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Detalles</a>&nbsp;&nbsp;
                                    <button value="'.$prod['CodigoProd'].'" class="btn btn-success btn-sm botonCarrito"><i class="fa fa-shopping-cart"></i>&nbsp; Añadir</button>
                                  </p>
                                </div>
                              </div>
                            </div>';
                          } 
                        }
                        else
                        {
                          echo '<h2>No hay productos en esta categoría</h2>'; 
                        }
                  echo '</div>'; 
                }
              ?>
              <!-- ==================== Fin contenedores de supermercados =============== -->
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php include './incluir/footer.php'; ?>
    <script>
        $(document).ready(function() {
            $('#store-links a:first').tab('show');
        });
    </script>
  </body>
</html>
