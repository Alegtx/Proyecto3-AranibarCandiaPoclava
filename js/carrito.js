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
//Cuando se muestran todos los productos
$(document).ready(function() {
    //Cargar el php en el modal del carrito
    $('#carrito-compras-tienda').load("procesos/carrito");
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
                $('h5').html("<font color='red'><i class='fa fa-exclamation-triangle'></i><br>Todos los productos deben ser del mismo supermercado.</font>");
            }
            else{
                $('h5').html("El producto se añadio al carrito correctamente.");
            }
        }
        
        //alert(Supermercado+" - "+Cookie_Supermercado);

        //Cargar carrito.php pasando el codigo y cantidad del producto
        $('#carrito-compras-tienda').load("procesos/carrito?CodProd="+$(this).val()+"&Cantidad="+Stock);
        $('.modal-carrito').modal('show');
    });
    $(".carrito-button-nav").click(function(){
        $("#container-carrito-compras").animate({height: 'toggle'},200);
    });
});

//Cuando se filtra por categoria
$(document).ready(function() {
    
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
                $('h5').html("<font color='red'><i class='fa fa-exclamation-triangle'></i><br>Todos los productos deben ser del mismo supermercado.</font>");
            }
            else{
                $('h5').html("El producto se añadio al carrito correctamente.");
            }
        }
        
        //alert(Supermercado+" - "+Cookie_Supermercado);

        //Cargar carrito.php pasando el codigo y cantidad del producto
        $('#carrito-compras-tienda').load("procesos/carrito?CodProd="+$(this).val()+"&Cantidad="+Stock);
        $('.modal-carrito').modal('show');
    });
});

//Cuando se filtra por supermercado
$(document).ready(function() {
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
                $('h5').html("<font color='red'><i class='fa fa-exclamation-triangle'></i><br>Todos los productos deben ser del mismo supermercado.</font>");
            }
            else{
                $('h5').html("El producto se añadio al carrito correctamente.");
            }
        }
        
        //alert(Supermercado+" - "+Cookie_Supermercado);

        //Cargar carrito.php pasando el codigo y cantidad del producto
        $('#carrito-compras-tienda').load("procesos/carrito?CodProd="+$(this).val()+"&Cantidad="+Stock);
        $('.modal-carrito').modal('show');
    });
});