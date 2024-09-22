function aprovar(idAluno, idFormacao){
    $.ajax({
        type: "POST",
        url: "../app/requests/matricula.php",
        dataType: "json",
        data: {
            acao: 'aprovarMatricula',
            idFormacao: idFormacao
        },
        success: function (data) {
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
        }
    });
}

function reprovar(idAluno, idFormacao){
    $.ajax({
        type: "POST",
        url: "../app/requests/matricula.php",
        dataType: "json",
        data: {
            acao: 'reprovarMatricula',
            idFormacao: idFormacao
        },
        success: function (data) {
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
        }
    });
}