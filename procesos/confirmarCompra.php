<?php
  /*
    Diesño de la matriz: 
    $_SESSION["productos"][X][0] = CodigoProducto
    $_SESSION["productos"][X][1] = Precio
    $_SESSION["productos"][X][2] = Cantidad
  */
  session_start(); 
  error_reporting(E_PARSE);
  include '../conexion/configServer.php';
  include '../conexion/consultaSQL.php';
  $num = $_POST['clien-number'];
  if($num == 'notlog')
  {
     $nameClien =$_POST['clien-name'];
     $passClien = md5($_POST['clien-pass']); 
  }
  if($num == 'log')
  {
     $nameClien = $_POST['clien-name'];
     $passClien = $_POST['clien-pass']; 
  }
  sleep(3);

  $verdata = ejecutarSQL::consultar("select * from cliente where Clave='".$passClien."' and Usuario='".$nameClien."'");
  $num =  mysqli_num_rows($verdata);
  if($num > 0)
  {
    if($_SESSION['sumaTotal'] > 0)
    {
      $data = mysqli_fetch_array($verdata);
      $nitC = $data['NIT'];
      $StatusV = "Pendiente";
      
      //Insertando datos en tabla venta
      consultasSQL::InsertSQL("venta", "NIT, Descuento, TotalPagar, Estado, NombreAdmin", "'".$nitC."','0','".$_SESSION['sumaTotal']."','".$StatusV."','".$_SESSION['supermercado']."'");
      
      //Recuperando el número del pedido actual
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
          $prodStock=ejecutarSQL::consultar("select * from producto where CodigoProd='".$_SESSION['productos'][$i+1][0]."'");
          while($fila = mysqli_fetch_array($prodStock))
          {
              $existencias = $fila['Stock'];
              consultasSQL::UpdateSQL("producto", "Stock=('$existencias'-".$_SESSION['productos'][$i+1][2].")", "CodigoProd='".$_SESSION['productos'][$i+1][0]."'");
          }
        }   
      }
      /*Vaciando el carrito*/
      unset($_SESSION['productos']);
      unset($_SESSION['contador']);
      unset($_SESSION['supermercado']);
      
      echo '<img src="assets/img/ok.png" class="center-all-contens"><br>El pedido se ha realizado con éxito';

      echo "<script> 
              window.location.replace('https://kh.cm/9ERgJ'); 
            </script>";
    }
    else
    {
      echo '<img src="assets/img/error.png" class="center-all-contens"><br>No has seleccionado ningún producto, revisa el carrito de compras';
    }
  }
  else
  {
      echo '<img src="assets/img/error.png" class="center-all-contens"><br>El nombre o contraseña invalidos';
  }
?>