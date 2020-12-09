<?php
	session_start();
	include '../conexion/configServer.php';
  	include '../conexion/consultaSQL.php';
	sleep(3);
	$fechaRecogo = $_POST['fecha-recogo'];
	if($_SESSION['sumaTotal'] > 0)
	{
		if($fechaRecogo != "")
	    {	
	    	//Obtener datos del cliente.
	    	$verdata = ejecutarSQL::consultar("select * from cliente where Usuario='".$_SESSION['nombreUser']."'");
			$data = mysqli_fetch_array($verdata);
			$nitC = $data['NIT'];
			$verId = ejecutarSQL::consultar("select * from venta order by NumPedido desc limit 1");
			while($fila = mysqli_fetch_array($verId))
			{
			  $Numpedido = $fila['NumPedido'] + 1;
			}
	    	$_SESSION['fechaRecogo'] = $fechaRecogo;

	    	//Llenar el texto con los detalles de compra
	    	$ContenidoCarrito = "";
			for ($i = 0; $i < $_SESSION['contador']; $i++) 
	    	{ 
	    		$consulta = ejecutarSQL::consultar("select * from producto where CodigoProd='".$_SESSION["productos"][$i+1][0]."'");
				while($fila = mysqli_fetch_array($consulta))
				{
					$ContenidoCarrito = $ContenidoCarrito." ■ ".$fila['NombreProd']." - ".number_format($_SESSION["productos"][$i+1][1], 2)." Bs. - x".$_SESSION["productos"][$i+1][2].PHP_EOL;
				}
			}

	    	// Llenamos los parametros
			$receiver_id = '354062';
			$subject = 'PEDIDO N°: '.$Numpedido;
			$body = $ContenidoCarrito;
			$amount = str_replace('.',',',$_SESSION['sumaTotal']);
			$notify_url = '';
			$return_url = 'http://localhost/Shopon-line/procesos/confirmarCompra';
			$cancel_url = '';
			$transaction_id = 'SHOPON-'.$Numpedido;
			$expires_date = time() + (30 * 24 * 60 * 60); //30 dias a partir de ahora
			$payer_email = 'shopon-line@gmail.com';
			$bank_id='';
			$picture_url = '';
			$secret = '10c44368986151d885b286cd8de65a7735ced448';
			$custom = 'El pedido debe ser recogido el '.$fechaRecogo.' segun las instrucciones del cliente';

			$khipu_url = 'https://khipu.com/api/1.3/createPaymentPage';

			// creamos el hash
			$concatenated = "receiver_id=$receiver_id&subject=$subject&body=$body&amount=$amount&payer_email=$payer_email&bank_id=$bank_id&expires_date=$expires_date&transaction_id=$transaction_id&custom=$custom&notify_url=$notify_url&return_url=$return_url&cancel_url=$cancel_url&picture_url=$picture_url";

			$hash = hash_hmac('sha256', $concatenated , $secret);
			echo '
				<form name="myForm" id="myForm" action="'.$khipu_url.'" method="post">
				<input type="hidden" name="receiver_id" value="'.$receiver_id.'">
				<input type="hidden" name="subject" value="'.$subject.'"/>
				<input type="hidden" name="body" value="'.$body.'">
				<input type="hidden" name="amount" value="'.$amount.'">
				<input type="hidden" name="notify_url" value="'.$notify_url.'"/>
				<input type="hidden" name="return_url" value="'.$return_url.'"/>
				<input type="hidden" name="cancel_url" value="'.$cancel_url.'"/>
				<input type="hidden" name="custom" value="'.$custom.'">
				<input type="hidden" name="transaction_id" value="'.$transaction_id.'">
				<input type="hidden" name="payer_email" value="'.$payer_email.'">
				<input type="hidden" name="expires_date" value="'.$expires_date.'">
				<input type="hidden" name="bank_id" value="'.$bank_id.'">
				<input type="hidden" name="picture_url" value="'.$picture_url.'">
				<input type="hidden" name="hash" value="'.$hash.'">
				</form>
				<script>
				    submitform();
				    function submitform()
				    {
				      document.myForm.submit();
				    }
				</script>
			';
	    }
    else
    {
      echo '<img src="assets/img/error.png" class="center-all-contens"><br>Por favor especifique la fecha en que desea recoger su pedido';
    }
  }
  else
  {
    echo '<img src="assets/img/error.png" class="center-all-contens"><br>No has seleccionado ningún producto, revisa el carrito de compras';
  }

?>
