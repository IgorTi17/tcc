function atualizaStatus(id, status){
	$.ajax({
        url: 'includes/ajax/atualizaStatus.php',
        data: {
            'id': id,
            'status': status
        },
        type: 'POST',
        success: function(data) {
            if(data == 1){
            	$(location).attr('href', 'pedidos-list.php?msg=update');
            }
        }
    });
}