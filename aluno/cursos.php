<?php
session_start();
require_once '../app/controller/CursosController.php';
$cursos = new CursosController();
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
        <?= $cursos->listarCursos() // COLOCAR ID DO USUÁRIO PELA SESSÃO APÓS IMPLEMENTAÇÃO DE LOGIN ?> 
        <a class="btn btn-secondary" data-bs-toggle="collapse" href="#novaFormacao" role="button" aria-expanded="false" aria-controls="novaFormacao">
            Novo curso
        </a>
        <div class="collapse" id="novaFormacao">
            <br>
            <div class="card card-body">
                <form class="row g-3">
                    <div class="col-lg-4">
                        <label for="nome" class="form-label">Curso</label>
                        <input type="text" class="form-control" id="nome" required>
                    </div>
                    <div class="col-lg-4">
                        <label for="instittuicao" class="form-label">Instituição</label>
                        <input type="text" class="form-control" id="instituicao" required>
                    </div>

                    <div class="col-lg-4">
                        <label for="nivel" class="form-label">Nível</label>
                        <input type="text" class="form-control" id="nivel" required>
                    </div>
                    <div class="col-lg-4">
                        <label for="inicio" class="form-label">Inicio</label>
                        <input type="date" class="form-control" id="inicio" required>
                    </div>
                    <div class="col-lg-4">  
                        <label for="fim" class="form-label">Fim</label>
                        <input type="date" class="form-control" id="fim" required>
                    </div>
                    <div class="col-lg-4">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" class="form-control" id="status" required>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success" onclick="salvarCurso()">
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
                    Editar Curso
                </h4>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="form-group">
                        <label for="cursoEdit">Curso</label>
                        <input type="text" name="curso" id="cursoEdit" class="form-control" required>
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
                    <input type="hidden"  id="idAluno" class="form-control" required>
                    <input type="hidden"  id="idCurso" class="form-control" required>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success" id='salvarEdit' onclick="editarCurso()">Salvar alterações</button>
            </div>
        </div>
    </div>
</div>

<script>
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
</script>

<?php
$content = ob_get_clean(); 
$pageTitle = "Cursos"; 
include('../app/public/html/template.php');
?>