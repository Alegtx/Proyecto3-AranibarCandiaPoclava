$(document).ready(function() {
	//Cargar el php en el modarl del carrito
    $('#carrito-compras-tienda').load("procesos/carrito");
    $(".botonCarrito").click(function(){
    	//Obtener el valor del input nunmber
    	var Stock=$('#stock'+$(this).val()).val();
    	//Poner en 1 el valor de input number
    	$('#stock'+$(this).val()).val("1");
    	//Cargar carrito.php pasando el codigo y cantidad del producto
        $('#carrito-compras-tienda').load("procesos/carrito?CodProd="+$(this).val()+"&Cantidad="+Stock);
        $('.modal-carrito').modal('show');
    });
    $(".carrito-button-nav").click(function(){
        $("#container-carrito-compras").animate({height: 'toggle'},200);
    });
});