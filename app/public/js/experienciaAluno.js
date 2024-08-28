// função para puxar os valores do banco de dados na MODAL
$(document).ready(function() {
    $('.btn-primary').on('click', function() {
        var id = $(this).val(); 
        console.log(id);
        $.ajax({
            type: "post",
            url: "../app/requests/ExperienciaController.php",
            dataType: 'json',
            data: {
                acao: 'getAll',
                id: id
            },
            success: function(data) {
                $('#empresaEdit').val(data.nome);
                $('#cargoEdit').val(data.cargo);
                $('#inicioEdit').val(data.inicio);
                $('#fimEdit').val(data.fim);
                $('#tipoEdit').val(data.tipo);
                $('#atividadeEdit').val(data.atividades);
                $('#idAluno').val(data.id_aluno);
                $('#idExp').val(data.id_exp);
            },
            error: function(xhr, status, error) {
                console.log("Erro ao receber os dados:", error);
            }
        });

        // Mostra o modal do Bootstrap
        $('#staticBackdrop').modal('show');
    });
    
    $('[data-dismiss="modal"]').on('click', function(){
        $('#staticBackdrop').modal('hide');
    });
});

function salvarExperiencia() {
    event.preventDefault();
    var empresa = $('#empresa').val();
    var cargo = $('#cargo').val();
    var inicio = $('#inicio').val();
    var fim = $('#fim').val();
    var tipo = $('#tipo').val();
    var atividade = $('#atividade').val();
    $.ajax({
        type: "post",
        url: "../app/requests/ExperienciaController.php",
        dataType: 'json',
        data: {
            acao: 'salvar',
            empresa: empresa,
            cargo:cargo,
            inicio: inicio,
            fim: fim,
            tipo: tipo,
            atividade: atividade
        },
        success: function(data) {
                Swal.fire({
                    title: data.tittle,
                    text: data.msg,
                    icon: data.icon
                }).then(() => {
                    location.reload();
                });
        },
        error: function(error,xhr,status) {
            console.log(error,xhr,status);
        }
    })
}

function editarExperiencia(){
    var idExperiencia = $('#idExp').val();
    var nome = $('#empresaEdit').val();
    var cargo = $('#cargoEdit').val();
    var inicio = $('#inicioEdit').val();
    var fim = $('#fimEdit').val();
    var tipo = $('#tipoEdit').val();
    var atividade = $('#atividadeEdit').val();
    $.ajax({
        url: "../app/requests/ExperienciaController.php",
        type: 'POST',
        dataType: 'json',
        data: {
            acao: 'editar',
            id: idExperiencia,
            nome: nome,
            cargo: cargo,
            inicio: inicio,
            fim: fim,
            tipo: tipo,
            atividade: atividade
        },
        success: function(data) {
            if(data.success) {
                Swal.fire({
                    title: data.tittle,
                    text: data.msg,
                    icon: data.icon
                }).then(() => {
                    $('#staticBackdrop').modal('hide');
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

function excluirExperiencia(id) { 
    Swal.fire({
        title: "Quer mesmo excluir essa experiência? ",
        text: "Você não poderá reverter esta ação!",
        icon: "warning",
        showCancelButton: true,
        cancelButtonColor: "#d33",
        cancelButtonText: 'Não',
        confirmButtonColor: "#3085d6",
        confirmButtonText: "Sim"
    }).then((result) => {
    if (result.isConfirmed) {
        $.ajax({
            url: "../app/requests/ExperienciaController.php",
            type: 'POST',
            dataType: 'json',
            data: {
                acao: 'excluir',
                id: id
            },
            success: function(data) {
                if(data.success) {
                    Swal.fire({
                        title: data.tittle,
                        text: data.msg,
                        icon: data.icon
                    }).then(() => {
                        $('#staticBackdrop').modal('hide');
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
    });
}