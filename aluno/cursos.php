<?php
session_start();
require_once '../app/controller/CursosController.php';
$cursos = new CursosController();
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

<script src="../app/public/js/cursosAluno.js"></script>

<?php
$content = ob_get_clean(); 
$pageTitle = "Cursos"; 
include('../app/public/html/template.php');
?>