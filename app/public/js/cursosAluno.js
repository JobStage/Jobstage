// função para puxar os valores do banco de dados na MODAL
$(document).ready(function() {
    $('.btn-primary').on('click', function() {
        var id = $(this).val(); 
        console.log(id);
        // AJAX -----------------------------------------
        $.ajax({
            type: "post",
            url: "../app/controller/CursosController.php",
            dataType: 'json',
            data: {
                acao: 'getAll',
                id: id
            },
            success: function(data) {
                $('#cursoEdit').val(data.nome_curso);
                $('#instituicaoEdit').val(data.instituicao);
                $('#nivelEdit').val(data.nivel);
                $('#inicioEdit').val(data.inicio);
                $('#fimEdit').val(data.fim);
                $('#statusEdit').val(data.status);
                $('#idAluno').val(data.id_aluno);
                $('#idCurso').val(data.id_curso);
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

function salvarCurso() {
    event.preventDefault();
    var nome = $('#nome').val();
    var instituicao = $('#instituicao').val();
    var nivel = $('#nivel').val();
    var inicio = $('#inicio').val();
    var fim = $('#fim').val();
    var status = $('#status').val();
    $.ajax({
        type: "post",
        url: "../app/controller/CursosController.php",
        dataType: 'json',
        data: {
            acao: 'salvar',
            nome: nome,
            instituicao:instituicao,
            nivel: nivel,
            inicio: inicio,
            fim: fim,
            status: status
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

function editarCurso(){
    var idCurso = $('#idCurso').val();
    var nome = $('#cursoEdit').val();
    var instituicao = $('#instituicaoEdit').val();
    var nivel = $('#nivelEdit').val();
    var inicio = $('#inicioEdit').val();
    var fim = $('#fimEdit').val();
    var status = $('#statusEdit').val();

    // $('#staticBackdrop').modal('hide');

    // CRIAR AJAX -----------
    $.ajax({
        url: "../app/controller/CursosController.php",
        type: 'POST',
        dataType: 'json',
        data: {
            acao: 'editar',
            idCurso: idCurso,
            nome: nome,
            instituicao: instituicao,
            nivel: nivel,
            inicio: inicio,
            fim: fim,
            status: status
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

function excluirCurso(id) { 
    Swal.fire({
        title: "Quer mesmo excluir esse curso? ",
        text: "Você não poderá reverter esta ação!",
        icon: "warning",
        showCancelButton: true,
        cancelButtonColor: "#d33",
        cancelButtonText: 'Não',
        confirmButtonColor: "#3085d6",
        confirmButtonText: "Sim"
    }).then((result) => {
    if (result.isConfirmed) {
            // CRIAR AJAX -----------------
        $.ajax({
            url: "../app/controller/CursosController.php",
            type: 'POST',
            dataType: 'json',
            data: {
                acao: 'excluir',
                idCurso: id
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