<?php
    include '../conexion/configServer.php';
    include '../conexion/consultaSQL.php';

    $totalpedidos = ejecutarSQL::consultar("select * from detalle where NumPedido='".$_GET["nro_pedido"]."'");
    echo "
    	<h4><b>Pedido N°:&nbsp;&nbsp;&nbsp;".$_GET["nro_pedido"]."</b></h4>
    	<div class='modal-text'>
		    <table class='table'>
				<thead>
					<th>#</th>
					<th>Producto</th>
					<th>Cantidad</th>
					<th>Precio</th>
				</thead>
				<tbody>
		";
    $NroLista = 0;
    $Total = 0;
    while($detalle = mysqli_fetch_array($totalpedidos))
    {
    	$NroLista++;
    	$totalproductos = ejecutarSQL::consultar("select * from producto where CodigoProd='".$detalle['CodigoProd']."'");
    	while($producto = mysqli_fetch_array($totalproductos))
    	{
    		$Subtotal = $detalle['CantidadProductos'] * $producto['Precio'];
			echo "<tr>
					<td>".$NroLista."</td>
					<td>".$producto['NombreProd']."</td>
					<td>".$detalle['CantidadProductos']."</td>
					<td>".number_format($Subtotal, 2)." Bs.</td>
				</tr>";
			$Total += $Subtotal;
    	}
	}
	echo "		<tr>
					<td></td>
					<td></td>					
					<td><b>Total</b></td>
					<td>".number_format($Total, 2)." Bs.</td>

				</tr>
				</tbody>
			</table>
		</div>	
	";
?>
