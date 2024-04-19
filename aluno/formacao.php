<?php
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
                    $('#instituicaoEdit').val(data.instituicao);
                    $('#nivelEdit').val(data.nivel);
                    $('#statusEdit').val(data.status);
                    $('#idAluno').val(data.id_aluno);
                    $('#idFormacao').val(data.id_formacao);
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

        if(file['type'] != 'application/pdf'){
            Swal.fire({
                    title: "Erro!",
                    text: "Envie somente arquivos PDF!",
                    icon: "error"
                    });
            return;
        }
        formData.append('file', file);

        $.ajax({
            url: '../app/controller/uploadMatricula.php',
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
                });
                
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }



    function editarFormacao(){
        var idaluno = $('#idAluno').val();
        var idFormacao = $('#idFormacao').val();
        var curso = $('#cursoEdit').val();
        var instituicao = $('#instituicaoEdit').val();
        var nivel = $('#nivelEdit').val();
        var status = $('#statusEdit').val();

        Swal.fire({
            title: "Sucesso!",
            text: "Formação atualizada com sucesso",
            icon: "success"
        });
        $('#staticBackdrop').modal('hide');

        // CRIAR AJAX -----------
    }

    function excluirFormacao(id) { 
        Swal.fire({
            title: "Quer mesmo excluir essa formação? " + id,
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

                Swal.fire({
                title: "Sucesso!",
                text: "Formação deletada com sucesso!",
                icon: "success"
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
