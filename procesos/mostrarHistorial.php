<?php
    include '../conexion/configServer.php';
    include '../conexion/consultaSQL.php';

    if($_GET['usuario'] == "")
    {
    	echo "
    		<p class='text-center'><i class='fa fa-exclamation-triangle fa-3x'></i><br>
    		Para ver su historial de pedidos primero debe iniciar sesion.</p>
    		";
    }
    else
    {
    	$totalclientes = ejecutarSQL::consultar("select * from cliente where Usuario = '".$_GET["usuario"]."'");
    	$CantidadPedidos = 0;
	    while ($cliente = mysqli_fetch_array($totalclientes))
	    {
	    	$CantidadPedidos++;
	    	$totalpedidos = ejecutarSQL::consultar("select * from venta where NIT = '".$cliente["NIT"]."' order by NumPedido desc");
	    	echo '
	    		<div class="table-responsive">
			    	<table class="table table-bordered text-center>
			            <thead class="">
			                <tr>
				                <th class="text-center">#</th>
				                <th class="text-center">Fecha</th>
				                <th class="text-center">Total</th>
				                <th class="text-center">Estado</th>
				                <th class="text-center">Fecha de entrega</th>
				                <th class="text-center">Fecha de recogo</th>
				                <th class="text-center">Opciones</th>
			            	</tr>
			            </thead>
			            <tbody class="text-center">
	    	';
		    while($pedido = mysqli_fetch_array($totalpedidos))
		    {
		    	echo '	    		
				    		<tr>
				                <td>'.$pedido['NumPedido'].'</td>
				                <td>'.$pedido['Fecha'].'</td>
				                <td>'.$pedido['TotalPagar'].' Bs.</td>
				                <td>'.$pedido['Estado'].'</td>
				                <td>'.$pedido['FechaEntrega'].'</td>
				                <td>'.$pedido['FechaRecogo'].'</td>
			                    <td class="text-center">
			                      	<div onClick="verDetallePedido('."'".$pedido['NumPedido']."'".')"
			                      	class="btn btn-sm btn-info">Detalle</div>
			                    </td>
				            </tr>
		            ';
			}
			echo "
						</tbody>
					</table>
				</div>";
	    }
	    if($CantidadPedidos == 0)
	    {
	    	echo "
	    		<p class='text-center'><i class='fa fa-shopping-cart fa-3x'></i><br>
	    		Toadiva no ha realizado ningun pedido.</p>
    		";
	    }
    }
?>