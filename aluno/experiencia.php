<?php
session_start();
require_once 'verificaSessao.php';
require_once '../app/controller/ExperienciaController.php';
$experiencia = new ExperienciaController();
ob_start(); 
?>
<div class="card">
  <nav class="nav nav-pills flex-column flex-sm-row">
    <a class="flex-sm-fill text-sm-center nav-link" aria-current="page" href="dados.php">Dados</a>
    <a class="flex-sm-fill text-sm-center nav-link" href="formacao.php">Formação</a>
    <a class="flex-sm-fill text-sm-center nav-link" href="cursos.php">Cursos</a>
    <a class="flex-sm-fill text-sm-center nav-link" href="experiencia.php">Experiência</a>
  </nav>
</div>

<div class="card">
    <div class="card-body">
        <?= $experiencia->listarExperiencia() ?> 
        <a class="btn btn-secondary" data-bs-toggle="collapse" href="#novaFormacao" role="button" aria-expanded="false" aria-controls="novaFormacao">
            Nova experiencia
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
                      
                        <input type="checkbox" id="atual" class="form-check-input">
                        <label for="atual" class="form-check-label">Atual</label>
       
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

                        <input type="checkbox" id="atualEdit" class="form-check-input">
                        <label for="atualEdit" class="form-check-label">Atual</label>
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
<script src="../app/public/js/experienciaAluno.js"></script>

<?php
$content = ob_get_clean(); 
$pageTitle = "Experiencia"; 
include('../app/public/html/template.php');
?>