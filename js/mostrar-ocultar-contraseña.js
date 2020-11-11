$(document).ready(function(){
    /*Funcion para mostrar u ocultar la contraseña*/
    $('#mostrar-ocultar').click(function(){
        if($(this).hasClass('fa fa-eye'))
        {
            $('#password').removeAttr('type','text');
            $('#mostrar-ocultar').addClass('fa-eye-slash').removeClass('fa-eye');
        }
        else
        {
            $('#password').attr('type','password');
            $('#mostrar-ocultar').addClass('fa-eye').removeClass('fa-eye-slash');
        }
    });
});