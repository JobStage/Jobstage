<?php
session_start();
require_once '../app/controller/ExperienciaController.php';
$experiencia = new ExperienciaController();
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
        <?= $experiencia->listarExperiencia() ?> 
        <a class="btn btn-secondary" data-bs-toggle="collapse" href="#novaFormacao" role="button" aria-expanded="false" aria-controls="novaFormacao">
            Nova Formação
        </a>
        <div class="collapse" id="novaFormacao">
            <br>
            <div class="card card-body">
                <form class="row g-3">
                  <div class="col-lg-6">
                      <label for="empresa" class="form-label">Empresa</label>
                      <input type="text" class="form-control" id="empresa" required>
                  </div>
                    <div class="col-lg-6">
                        <label for="nome" class="form-label">Cargo</label>
                        <input type="text" class="form-control" id="cargo" required>
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
                        <label for="tipo" class="form-label">Tipo</label>
                        <input type="text" class="form-control" id="tipo" required>
                    </div>
                    <div class="col-lg-12">
                        <label for="atividade" class="form-label">Atividades</label>
                        <textarea class="form-control" id="atividade" cols="30" rows="10" required></textarea>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success" onclick="salvarExperiencia()">
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
                    Editar Experiencia
                </h4>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="form-group">
                        <label for="empresaEdit" class="form-label">Empresa</label>
                        <input type="text" class="form-control" id="empresaEdit" required>
                    </div>
                    <div class="form-group">
                        <label for="cargoEdit" class="form-label">Cargo</label>
                        <input type="text" class="form-control" id="cargoEdit" required>
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
                        <label for="tipoEdit" class="form-label">Tipo</label>
                        <input type="text" class="form-control" id="tipoEdit" required>
                    </div>
                    <div class="form-group">
                        <label for="atividadeEdit" class="form-label">Atividades</label>
                        <input type="text" class="form-control" id="atividadeEdit" required>
                    </div>
                    <input type="hidden"  id="idAluno" class="form-control" required>
                    <input type="hidden"  id="idExp" class="form-control" required>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success" id='salvarEdit' onclick="editarExperiencia()">Salvar alterações</button>
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
            $.ajax({
                type: "post",
                url: "../app/controller/ExperienciaController.php",
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
            url: "../app/controller/ExperienciaController.php",
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
            url: "../app/controller/ExperienciaController.php",
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
                url: "../app/controller/ExperienciaController.php",
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
</script>

<?php
$content = ob_get_clean(); 
$pageTitle = "Experiencia"; 
include('../app/public/html/template.php');
?>