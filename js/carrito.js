//función para leer la cookie
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
$(document).ready(function() {
    //Cargar el php en el modal del carrito
    $('#carrito-compras-tienda').load("procesos/carrito");

    //Mostrar carrito
    $(".carrito-button-nav").click(function(){
        $("#container-carrito-compras").animate({height: 'toggle'},200);
    });

    //Cuando se muestran todos los productos
    $(".botonCarrito").click(function(){
        //Obtener el valor del input nunmber
        var Stock = $('#stock-'+$(this).val()).val();
        //Poner en 1 el valor de input number
        $('#stock-'+$(this).val()).val("1");

        //Obtener el supermercado del producto elegido
        var Supermercado = $('#modal-'+$(this).val()).val();
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



    //Cuando se filtra por categoria
    $(".botonCarritoCategoria").click(function(){
        //Obtener el valor del input nunmber
        var Stock = $('#categoria-stock-'+$(this).val()).val();
        //Poner en 1 el valor de input number
        $('#categoria-stock-'+$(this).val()).val("1");

        //Obtener el supermercado del producto elegido
        var Supermercado = $('#categoria-modal-'+$(this).val()).val();
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

    //Cuando se filtra por supermercado
    $(".botonCarritoSupermercado").click(function(){
        //Obtener el valor del input nunmber
        var Stock = $('#supermercado-stock-'+$(this).val()).val();
        //Poner en 1 el valor de input number
        $('#supermercado-stock-'+$(this).val()).val("1");

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
});

function verDetallePedido(modal){
    var options = {
            modal: true,
            height:300,
            width:600
        };
        // Realiza la consulta al fichero php para obtener información de la BD.
        $('#conte-modal').load('procesos/mostrarDetalle.php?nro_pedido='+modal, function() {
        $('#modal-detalles').modal({show:true});
    });    
}

function verHistorialPedido(modal){
    var options = {
            modal: true,
            height:1200,
            width:1200
        };
        // Realiza la consulta al fichero php para obtener información de la BD.
        $('#conte-modal-historial').load('procesos/mostrarHistorial.php?usuario='+modal, function() {
        $('#modal-historial').modal({show:true});
    });    
}


