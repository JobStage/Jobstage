<?php
session_start();
require_once '../app/controller/FormacaoController.php';
require_once '../app/controller/curso.php';
$formacao = new FormacaoController();
$cursos = new cursos();
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
            Nova formação
        </a>
        <div class="collapse" id="novaFormacao">
            <br>
            <div class="card card-body">
                <form class="row g-3" id="uploadForm" enctype="multipart/form-data">
                    <div class="col-lg-4">
                        <label for="instittuicao" class="form-label">Instituição</label>
                        <input type="text" class="form-control" id="instittuicao" required>
                    </div>
                    <div class="col-lg-4">
                        <label for="nivel" class="form-label">Nível</label>
                        <select type="text" class="form-control" id="nivel" required><?=$cursos->getNivel() ?></select>
                    </div>
                    <div class="col-lg-4">
                        <label for="curso" class="form-label">Curso</label>
                        <select type="text" class="form-control" id="curso" required disabled> </select>
                    </div>
                    <!-- <div class="col-lg-4">
                        <label for="estado" class="form-label">Estado</label>
                        <input type="text" class="form-control" id="estado" required disabled>
                    </div>
                    <div class="col-lg-4">
                        <label for="cidade" class="form-label">Cidade</label>
                        <input type="text" class="form-control" id="cidade" required disabled>
                    </div>
                    <div class="col-lg-2">
                        <label for="cep" class="form-label">CEP</label>
                        <input type="number" class="form-control" id="cep" required disabled>
                    </div>
                    <div class="col-lg-4">
                        <label for="rua" class="form-label">Rua</label>
                        <input type="text" class="form-control" id="rua" required disabled>
                    </div> -->
                                       
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
                    Editar formação
                </h4>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="form-group">
                        <label for="cursoEdit">Curso</label>
                        <input type="text" name="curso" id="cursoEdit" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="setorEdit" class="form-label">SetorTESTsE</label>
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

<script src="../app/public/js/formacaoAluno.js"></script>
<?php
$content = ob_get_clean(); 
$pageTitle = "Formação"; 
include('../app/public/html/template.php'); 
?>
