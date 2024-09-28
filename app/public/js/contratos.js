$(document).ready(function() {
    $('img[id^="abrirContratos"]').on('click', function() {
        // Pegar o idContrato do input relacionado
        var idContrato = $(this).closest('a').prevAll('input[id^="idContrato"]').val();
        var idAluno = $(this).closest('a').prevAll('input[id^="id_aluno"]').val();

        $('#verContratoLink').attr('href', 'verContrato.php?idContrato=' + idContrato);
        $('#verRelatorioLink').attr('href', 'relatorios.php?idAluno=' + idAluno);
    });
});



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