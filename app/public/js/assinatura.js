function assinaturaAluno(idUsuario){

    let assinatura = $("#ass").val();
    let idContrato = $("#idContrato").val();

    if(!assinatura){
        Swal.fire({
            title: 'Atenção',
            text: 'Campo de assinatura obrigatório',
            icon: 'warning'
        });
        return;
    }

    $.ajax({
        type: "post",
        url: "../app/requests/assinatura.php",
        dataType: 'json',
        data: {
            acao: 'assinar',
            id: idUsuario,
            ass: assinatura,
            idContrato: idContrato,
            tipo: 'aluno'
        },
        success: function (response) {
            
        }
    });
}