<html>
  <head>
      <title>Compra exitosa</title>
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
              /*
                Diesño de la matriz: 
                $_SESSION["productos"][X][0] = CodigoProducto
                $_SESSION["productos"][X][1] = Precio
                $_SESSION["productos"][X][2] = Cantidad
              */
              session_start();
              /*echo "GET: ".$_GET['hash'];
              echo "<br>SESSION: ".$_SESSION['hash'];*/

              //Comprobar que las variables que no sean nulas
              if(isset($_SESSION['supermercado']) && isset($_SESSION['productos']) && isset($_SESSION['hash']) && isset($_GET['hash']))
              {
                //Comporbar que el hash sea correcto
                if($_SESSION['supermercado'] != "" && ($_SESSION['hash'] == $_GET['hash']))
                {
                  error_reporting(E_PARSE);
                  include '../conexion/configServer.php';
                  include '../conexion/consultaSQL.php';

                  //Obtener nit del cliente
                  $verdata = ejecutarSQL::consultar("select * from cliente where Usuario='".$_SESSION['nombreUser']."'");
                  $data = mysqli_fetch_array($verdata);
                  $nitC = $data['NIT'];
                  $StatusV = "Pendiente";
                  
                  $fechaRecogo = $_SESSION['fechaRecogo']." ".$_SESSION['horaRecogo'];
                  //Insertando datos en tabla venta
                  consultasSQL::InsertSQL("venta", "NIT, TotalPagar, Estado, NombreAdmin, FechaRecogo", "'".$nitC."','".$_SESSION['sumaTotal']."','".$StatusV."','".$_SESSION['supermercado']."', '".$fechaRecogo."'");
                  
                  //Obtener el numero del pedido actual
                  $verId = ejecutarSQL::consultar("select * from venta where NIT='$nitC' order by NumPedido desc limit 1");
                  while($fila = mysqli_fetch_array($verId))
                  {
                    $Numpedido = $fila['NumPedido'];
                  }
                  
                  //Insertando datos en detalle de la venta
                  for($i = 0;$i < $_SESSION['contador'];$i++)
                  {
                    if($_SESSION['productos'][$i+1][0] != "")
                    {
                      consultasSQL::InsertSQL("detalle", "NumPedido, CodigoProd, CantidadProductos", "'$Numpedido', '".$_SESSION['productos'][$i+1][0]."', '".$_SESSION['productos'][$i+1][2]."'");

                      //Restando un stock a cada producto seleccionado en el carrito
                      $prodStock = ejecutarSQL::consultar("select * from producto where CodigoProd='".$_SESSION['productos'][$i+1][0]."'");
                      while($fila = mysqli_fetch_array($prodStock))
                      {
                          $existencias = $fila['Stock'];
                          consultasSQL::UpdateSQL("producto", "Stock=('$existencias'-".$_SESSION['productos'][$i+1][2].")", "CodigoProd='".$_SESSION['productos'][$i+1][0]."'");
                      }
                    }   
                  }
                }
              }
              //Vaciar carrito
              unset($_SESSION['productos']);
              unset($_SESSION['contador']);
              unset($_SESSION['supermercado']);
              unset($_SESSION['hash']);
              echo '
                <script>
                  //window.location = "../index";
                </script>
                ';
            ?>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>