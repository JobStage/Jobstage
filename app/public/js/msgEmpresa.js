function msgEmpresa(id, idDestino){
    let txt = $('#txt').val();
    $.ajax({
        type: "POST",
        url: '../app/requests/msg.php',
        dataType: "json",
        data: {
            acao: 'msgEmpresa',
            txt: txt,
            id: id,
            destino: idDestino
        },
        success: function (response) {
            if(response.sucesso){
                    location.reload();
            }else{
                Swal.fire({
                    title: 'Erro!',
                    text: 'Erro ao enviar mensagem',
                    icon: 'error'
                });
            }
        }
    });
}

function msgAluno(id, idDestino){
    let txt = $('#txt').val();
    $.ajax({
        type: "POST",
        url: '../app/requests/msg.php',
        dataType: "json",
        data: {
            acao: 'msgAluno',
            txt: txt,
            id: id,
            destino: idDestino
        },
        success: function (response) {
            if(response.sucesso){
                location.reload();
        }else{
            Swal.fire({
                title: 'Erro!',
                text: 'Erro ao enviar mensagem',
                icon: 'error'
            });
        }
        }
    });
}