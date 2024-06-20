 // função para puxar os valores do banco de dados na MODAL
 $(document).ready(function() {
    $('.btn-primary').on('click', function() {
        var id = $(this).val(); 
        

        // AJAX -----------------------------------------
        $.ajax({
            type: "post",
            url: "../app/controller/FormacaoController.php",
            dataType: 'json',
            data: {
                acao: 'getAll',
                id: id
            },
            success: function(data) {
                $('#cursoEdit').val(data.curso);
                $('#setorEdit').val(data.setor);
                $('#instituicaoEdit').val(data.instituicao);
                $('#nivelEdit').val(data.nivel);
                $('#inicioEdit').val(data.inicio);
                $('#fimEdit').val(data.fim);
                $('#statusEdit').val(data.status);
                $('#idAluno').val(data.id_aluno);
                $('#idFormacao').val(data.id_formacao);
                $('#matriculaEdit').attr('href', '../app/matricula/' + data.matricula); // adiciona o nome da matricula no diretório de upload
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

    $('#nivel').change(function() {
           
            sendAjaxRequestCurso(); 
        });
});


function salvarFormacao() {
    event.preventDefault();

    // Cria um objeto FormData
    var formData = new FormData();

    // Adiciona os valores do formulário ao objeto FormData
    formData.append('acao', 'criar');
    formData.append('curso', $('#nome').val());
    formData.append('setor', $('#setor').val());
    formData.append('instituicao', $('#instittuicao').val());
    formData.append('nivel', $('#nivel').val());
    formData.append('inicio', $('#inicio').val());
    formData.append('fim', $('#fim').val());
    formData.append('status', $('#status').val());
    
    // Adiciona o arquivo ao objeto FormData
    var file = $('#file').prop('files')[0];

    if(file){
        if(file['type'] != 'application/pdf'){
            Swal.fire({
                title: "Erro!",
                text: "Envie somente arquivos PDF!",
                icon: "error"
            });
            return;
        }
    }else{
        Swal.fire({
            title: "Erro!",
            text: "Todos os campos são obrigatórios!",
            icon: "warning"
        });
        return;
    }
    formData.append('file', file);

    $.ajax({
        url: '../app/controller/FormacaoController.php',
        type: 'POST',
        dataType: 'json',
        data: formData,
        processData: false, // Não processa os dados
        contentType: false, // Não defina automaticamente o tipo de conteúdo
        success: function(data) {
            Swal.fire({
                title: data.tittle,
                text: data.msg,
                icon: data.icon
            }).then(() => {
                location.reload();
            });
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}


function editarFormacao(){
    var formData = new FormData();

    formData.append('acao', 'editar');
    formData.append('curso', $('#cursoEdit').val());
    formData.append('setor', $('#setorEdit').val());
    formData.append('instituicao', $('#instituicaoEdit').val());
    formData.append('nivel', $('#nivelEdit').val());
    formData.append('inicio', $('#inicioEdit').val());
    formData.append('fim', $('#fimEdit').val());
    formData.append('status', $('#statusEdit').val());
    formData.append('file', $('#fileEdit').val());  // Este campo retorna o nome do arquivo, não o arquivo em si
    formData.append('idAluno', $('#idAluno').val());
    formData.append('idFormacao', $('#idFormacao').val());

    // Adiciona o arquivo ao objeto FormData
    var file = $('#fileEdit').prop('files')[0];

    if(file){
        if(file['type'] != 'application/pdf'){
            Swal.fire({
                title: "Erro!",
                text: "Envie somente arquivos PDF!",
                icon: "error"
            });
            return;
        }
    }
    formData.append('file', file);
    $.ajax({
        url: '../app/controller/FormacaoController.php',
        type: 'POST',
        dataType: 'json',
        data: formData,
        processData: false, // Não processa os dados
        contentType: false, // Não defina automaticamente o tipo de conteúdo
        success: function(data) {
            if(data.success){
            Swal.fire({
                title: data.tittle,
                text: data.msg,
                icon: data.icon
            }).then(() => {
                $('#staticBackdrop').modal('hide');
                location.reload();
            });
            }else{
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


function excluirFormacao(id) { 
    Swal.fire({
        title: "Quer mesmo excluir essa formação?",
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
                url: '../app/controller/FormacaoController.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    acao: 'excluir',
                    idFormacao: id
                },
                success: function(data) {
                    if(data.success){
                        Swal.fire({
                            title: data.tittle,
                            text: data.msg,
                            icon: data.icon
                        }).then(() => {
                            location.reload();
                        });
                    }else{
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
function sendAjaxRequestCurso() {
    var nivel = $('#nivel').val();
    // desativa e apaga dados cadastrados no input da area e do collapse
    $('#curso').attr('disabled', 'disabled').val('');

    if(nivel > 1){
        $('#curso').removeAttr('disabled');

        $.ajax({
            url: '../app/controller/curso.php',  // Substitua pelo seu endpoint de servidor
            type: 'POST',
            dataType: 'json',
            data: {
                nivel: nivel,
                tipo: 'listarCurso'
            },
            success: function(response) {
                $("#curso").html(response);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + error);
            }
        });
    }else{
        $('#curso').attr('disabled', 'disabled').val('');
    }
}

