function loadDynamicContentModal(modal){
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