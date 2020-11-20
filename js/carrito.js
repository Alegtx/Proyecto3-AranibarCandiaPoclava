
$(document).ready(function() {
	//Cargar el php en el modal del carrito
    $('#carrito-compras-tienda').load("procesos/carrito");
    //Cuando se muestran todos los productos
    $(".botonCarrito").click(function(){
    	//Obtener el valor del input nunmber
    	var Stock = $('#stock-'+$(this).val()).val();
    	//Poner en 1 el valor de input number
    	$('#stock-'+$(this).val()).val("1");

        var Supermercado = "<? echo $_SESSION['supermercado']; ?>";
        //var Supermercado = "holaa";
        $('h5').html(Supermercado);
    	//Cargar carrito.php pasando el codigo y cantidad del producto
        $('#carrito-compras-tienda').load("procesos/carrito?CodProd="+$(this).val()+"&Cantidad="+Stock);
        $('.modal-carrito').modal('show');
    });

    //Cuando se filtra por categoria
    $(".botonCarritoCategoria").click(function(){
        //Obtener el valor del input nunmber
        var Stock = $('#categoria-stock-'+$(this).val()).val();
        //Poner en 1 el valor de input number
        $('#categoria-stock-'+$(this).val()).val("1");
        //Cargar carrito.php pasando el codigo y cantidad del producto
        $('#carrito-compras-tienda').load("procesos/carrito?CodProd="+$(this).val()+"&Cantidad="+Stock);
        $('.modal-carrito').modal('show');
    });

    //Cuando se filtra por supermercado
    $(".botonCarritoSupermercado").click(function(){
        //Obtener el valor del input nunmber
        var Stock = $('#supermercado-stock-'+$(this).val()).val();
        //Poner en 1 el valor de input number
        $('#supermercado-stock-'+$(this).val()).val("1");
        //Cargar carrito.php pasando el codigo y cantidad del producto
        $('#carrito-compras-tienda').load("procesos/carrito?CodProd="+$(this).val()+"&Cantidad="+Stock);
        $('.modal-carrito').modal('show');
    });

    $(".carrito-button-nav").click(function(){
        $("#container-carrito-compras").animate({height: 'toggle'},200);
    });
});
