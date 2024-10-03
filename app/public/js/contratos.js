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
                Swal.fire({
                    title: data.tittle,
                    text: data.msg,
                    icon: data.icon
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire({
                    title: data.tittle,
                    text: data.msg,
                    icon: data.icon
                });
            };
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}