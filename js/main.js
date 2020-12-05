$(document).ready(function() {

    $("#navbar-auto-hidden").autoHidingNavbar();
    $(".button-mobile-menu").click(function(){
        $("#mobile-menu-list").animate({width: 'toggle'},200);
    });	
    $('.all-elements-tooltip').tooltip('hide');
    
    
    $('#modal-form-login form').submit(function(e) {
        e.preventDefault();
        var informacion=$('#modal-form-login form').serialize();
        var metodo=$('#modal-form-login form').attr('method');
        var peticion=$('#modal-form-login form').attr('action');
         
    });

    /*Funcion para enviar datos de formularios con ajax*/
    $('.FormCatElec').submit(function(e){
        e.preventDefault();
        var data = $(this).serialize();
        var type = $(this).attr('method');
        var url = $(this).attr('action');
        var formType = $(this).attr('data-form');

        if(formType == "login"){
            $.ajax({
                type: type,
                url: url,
                data: data,
                beforeSend: function(){
                    $(".ResFormL").html('Iniciando sesión<br><img src="assets/img/loading.gif" class="center-all-contens">');
                },
                error: function() {
                    $(".ResFormL").html("Ha ocurrido un error en el sistema");
                },
                success: function (data) {
                    $(".ResFormL").html(data);
                }
            });
            return false;
        }
        else
        {
            $.ajax({
                type: type,
                url: url,
                data: data,
                beforeSend: function(){
                    $(".ResForm").html('Procesando... <br><img src="assets/img/enviando.gif" class="center-all-contens">');
                },
                error: function() {
                    $(".ResForm").html("Ha ocurrido un error en el sistema");
                },
                success: function (data) {
                    $(".ResForm").html(data);
                }
            });
            return false;
        }
    });
});
$(function(){
    //Obtener la fecha minima para el input
    var fechaActual = new Date();
    var minDate = retornarFecha(fechaActual);
    //Obtener la fecha maxima para el input
    // (Dias * 24 horas * 60 minutos * 60 segundos * 1000 milésimas de segundo) 
    var añadirMes = 30 * 24 * 60 * 60 * 1000; 
    fechaMax = fechaActual.getTime() + (añadirMes); 
    var fechaFormateada = new Date(fechaMax); 
    var maxDate = retornarFecha(fechaFormateada);

    /*alert(minDate);
    alert(maxDate);*/
    $('#fecha-recogo').attr('min', minDate);
    $('#fecha-recogo').attr('max', maxDate);
});
function retornarFecha(fecha){
    var mes = fecha.getMonth() + 1;
    var dia = fecha.getDate();
    var año = fecha.getFullYear();
    if(mes < 10)
    {
        mes = '0' + mes.toString();
    }
    if(dia < 10)
    {
        dia = '0' + dia.toString();
    }
    var fechaNueva = año + '-' + mes + '-' + dia;
    return fechaNueva;
}
