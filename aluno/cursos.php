<?php
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
            Nova Formação
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
                        <input type="text" class="form-control" id="instittuicao" required>
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
                        <button type="submit" class="btn btn-success">
                            Salvar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
$content = ob_get_clean(); 
$pageTitle = "Cursos"; 
include('../app/public/html/template.php');
?>