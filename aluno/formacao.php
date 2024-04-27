<?php
session_start();
require_once '../app/controller/FormacaoController.php';
$formacao = new FormacaoController();
ob_start();  
?>

<div class="card">
    <nav class="nav nav-pills flex-column flex-sm-row">
        <a class="flex-sm-fill text-sm-center nav-link active" aria-current="page" href="dados.php">Dados</a>
        <a class="flex-sm-fill text-sm-center nav-link" href="formacao.php">Formação</a>
        <a class="flex-sm-fill text-sm-center nav-link" href="cursos.php">Cursos</a>
        <a class="flex-sm-fill text-sm-center nav-link" href="experiencia.php">Experiência</a>
    </nav>
</div>

<div class="card">
    <div class="card-body">
        <?= $formacao->listarFormacao() // COLOCAR ID DO USUÁRIO PELA SESSÃO APÓS IMPLEMENTAÇÃO DE LOGIN ?> 
        <a class="btn btn-secondary" data-bs-toggle="collapse" href="#novaFormacao" role="button" aria-expanded="false" aria-controls="novaFormacao">
            Nova Formação
        </a>
        <div class="collapse" id="novaFormacao">
            <br>
            <div class="card card-body">
                <form class="row g-3" id="uploadForm" enctype="multipart/form-data">
                    <div class="col-lg-4">
                        <label for="nome" class="form-label">Curso</label>
                        <input type="text" class="form-control" id="nome" required>
                    </div>
                    <div class="col-lg-4">
                        <label for="setor" class="form-label">Setor</label>
                        <input type="text" class="form-control" id="setor" required>
                    </div>
                    <div class="col-lg-4">
                        <label for="instittuicao" class="form-label">Instituição</label>
                        <input type="text" class="form-control" id="instittuicao" required>
                    </div>

                    <div class="col-lg-4">
                        <label for="nivel" class="form-label">Nível</label>
                        <input type="text" class="form-control" id="nivel" required>
                    </div>
                    <div class="col-lg-2">
                        <label for="inicio" class="form-label">Inicio</label>
                        <input type="date" class="form-control" id="inicio" required>
                    </div>
                    <div class="col-lg-2">
                        <label for="fim" class="form-label">Fim</label>
                        <input type="date" class="form-control" id="fim" required>
                    </div>
                    <div class="col-lg-4">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" class="form-control" id="status" required>
                    </div>
                    <div class="col-lg-12">
                        <label for="file" class="form-label">Matrícula</label>
                        <input type="file" class="form-control" id="file" required>
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success" onclick="salvarFormacao(event)">
                            Salvar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- MODAL -->
<div id="staticBackdrop" data-bs-backdrop="static" class="modal fade" tabindex="-1" aria-labelledby="modalEditar">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalEditar">
                    Editar Formação
                </h4>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="form-group">
                        <label for="cursoEdit">Curso</label>
                        <input type="text" name="curso" id="cursoEdit" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="setorEdit" class="form-label">Setor</label>
                        <input type="text" class="form-control" id="setorEdit" required>
                    </div>
                    <div class="form-group">
                        <label for="instituicaoEdit" class="form-label">Instituição</label>
                        <input type="text" class="form-control" id="instituicaoEdit" required>
                    </div>
                    <div class="form-group">
                        <label for="nivelEdit" class="form-label">Nível</label>
                        <input type="text" class="form-control" id="nivelEdit" required>
                    </div>
                    <div class="form-group">
                        <label for="inicioEdit" class="form-label">Inicio</label>
                        <input type="date" class="form-control" id="inicioEdit" required>
                    </div>
                    <div class="form-group">
                        <label for="fimEdit" class="form-label">Fim</label>
                        <input type="date" class="form-control" id="fimEdit" required>
                    </div>
                    <div class="form-group">
                        <label for="statusEdit" class="form-label">Status</label>
                        <input type="text" class="form-control" id="statusEdit" required>
                    </div>
                    <div class="form-group">
                        <label for="fileEdit" class="form-label">Matrícula</label>
                        <input type="file" class="form-control" id="fileEdit" required>
                        <a id="matriculaEdit" href="" target="_blank">
                            <img src="https://cdn-icons-png.flaticon.com/512/473/473554.png" alt="Ícone" style="width: 30px; height: 30px; margin-right: 5px;">
                            Matricula Atual
                        </a>
                    </div>
                    <input type="hidden"  id="idAluno" class="form-control">
                    <input type="hidden"  id="idFormacao" class="form-control">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success" id='salvarEdit' onclick="editarFormacao()">Salvar alterações</button>
            </div>
        </div>
    </div>
</div>


<script>
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
</script>
<?php
$content = ob_get_clean(); 
$pageTitle = "Formação"; 
include('../app/public/html/template.php'); 
?>
