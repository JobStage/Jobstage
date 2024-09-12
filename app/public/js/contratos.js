function gerarContrato(id){
    $.ajax({
        url: "../app/requests/contratos.php",
        type: 'POST',
        dataType: 'json',
        data: {
            acao: 'gerarContrato',
            id: id
        },
        success: function(data) {
            if(data.success) {

            } else {

            };
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}