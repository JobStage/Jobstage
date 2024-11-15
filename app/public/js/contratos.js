$(document).ready(function() {
    $('#abrirContratos').click(function(){
        // Abrir o modal
        $('#exampleModal').modal('show');
        
        var hash = $('#hash').val();
        var idAluno = $('#id_aluno').val();
        
        // Atualize os links no modal
        $('#verContratoLink').attr('href', 'verContrato.php?contrato=' + hash);
        $('#verRelatorioLink').attr('href', 'relatorios.php?idAluno=' + idAluno);
    });
});



function gerarContrato(id){
    $('#loadingModal').modal('show');
    $.ajax({
        url: "../app/requests/contratos.php",
        type: 'POST',
        dataType: 'json',
        data: {
            acao: 'gerarContrato',
            id: id
        },
        success: function(data) {
            $('#loadingModal').modal('hide');
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
            $('#loadingModal').modal('hide');
            console.error(xhr.responseText);
        }
    });
}

function desligamento(hash){
    $.ajax({
        url: "../app/requests/contratos.php",
        type: 'POST',
        dataType: 'json',
        data: {
            acao: 'desligamentoContrato',
            id: hash
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
            $('#loadingModal').modal('hide');
            console.error(xhr.responseText);
        }
    });
}