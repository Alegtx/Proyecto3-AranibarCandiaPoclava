<?php
	include '../conexion/configServer.php';
    include '../conexion/consultaSQL.php';

    $mensaje = "";
    $nombreProducto = $_POST['valorBusqueda'];
    if(isset($nombreProducto))
    {
    	$totalproductos = ejecutarSQL::consultar("select * from producto where NombreProd like '%".$nombreProducto."%' or Marca like '%".$nombreProducto."%'");
    	$cantfilas = mysqli_num_rows($totalproductos);
    	if($cantfilas == 0)
    	{
    		echo "<h2>No hay productos con el nombre de ".$nombreProducto."</h2>";
    	}
    	else
    	{
    		echo '
    			<br><br>
    			<div class="row">
    			';
    		while($producto = mysqli_fetch_array($totalproductos))
    		{
    			echo '
					<div class="col-xs-12 col-sm-6 col-md-4">
                      	<div class="thumbnail">
                        	<img src="assets/img-productos/'.$producto['Imagen'].'">
	                        <div class="caption">
	                         	<h3>'.$producto['NombreProd'].'</h3>
	                         	<p>'.$producto['Marca'].'</p>
	                         	<p>'.$producto['Precio'].' Bs.</p>
	                         	<p><b>'.$producto['NombreAdmin'].'</b></p>
	                         	<p>
		                         	<div class="number-input">
		                              	<button onclick="this.parentNode.querySelector('."'input[type=number]'".').stepDown()"></button>
		                              	<input min="1" max="'.$producto['Stock'].'" id="supermercado-busqueda-'.$producto['CodigoProd'].'" value="1" type="number" readonly>
		                              	<button onclick="this.parentNode.querySelector('."'input[type=number]'".').stepUp()" class="plus"></button>
		                            </div>
	                          	</p>
	                          	<input type="hidden" id="supermercado-modal-'.$producto['CodigoProd'].'" value="'.$producto['NombreAdmin'].'">
	                          	<p class="text-center">
	                            <a href="infoProducto.php?CodigoProd='.$producto['CodigoProd'].'" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Detalles</a>&nbsp;&nbsp;
	                            <button value="'.$producto['CodigoProd'].'" class="btn btn-success btn-sm botonCarritoBusqueda"><i class="fa fa-shopping-cart"></i>&nbsp; Añadir</button>
	                          </p>
                        	</div>
                      	</div>
                    </div>';
    		}
    		echo "</div>";
    	}
    }
    
?>
<script type="text/javascript">
	//Cuando se filtra por busqueda
    $(".botonCarritoBusqueda").click(function(){
        //Obtener el valor del input nunmber
        var Stock = $('#supermercado-busqueda-'+$(this).val()).val();
        //Poner en 1 el valor de input number
        $('#supermercado-busqueda-'+$(this).val()).val("1");

        //Obtener el supermercado del producto elegido
        var Supermercado = $('#supermercado-modal-'+$(this).val()).val();
        //Obtener cookie con el supermercado
        let Cookie_Supermercado = getCookie('Supermercado');
        //Comprobar que exista la cookie
        if(Cookie_Supermercado != ""){
            //Comprobar que el supermercado sea el mismo
            if(Cookie_Supermercado != Supermercado){
                $('#modal-carrito-img').html("<font color='red'><i class='fa fa-exclamation-triangle fa-5x'></i></font>");
                $('#modal-carrito-text').html("<font color='red'>Todos los productos deben ser del mismo supermercado.</font>");

            }
            else{
                $('#modal-carrito-img').html("<i class='fa fa-shopping-cart fa-5x'></i>");
                $('#modal-carrito-text').html("El producto se añadio al carrito correctamente.");
            }
        }
        else{
            $('#modal-carrito-img').html("<i class='fa fa-shopping-cart fa-5x'></i>");
            $('#modal-carrito-text').html("El producto se añadio al carrito correctamente.");
        }
        
        //alert(Supermercado+" - "+Cookie_Supermercado);

        //Cargar carrito.php pasando el codigo y cantidad del producto
        $('#carrito-compras-tienda').load("procesos/carrito?CodProd="+$(this).val()+"&Cantidad="+Stock);
        $('.modal-carrito').modal('show');
    });
</script>