<?php
session_start();
require_once '../app/controller/EmpresaController.php';
require_once '../app/controller/CidadeEstado.php';
$estado = new CidadeEstado();
$empresa = new EmpresaController($_SESSION['id']);
ob_start();  
?>
<div style="display: flex; justify-content: end; margin-top: 20px;">
    <button class="btn btn-primary" data-bs-toggle="collapse" href="#novaVaga" role="button" aria-expanded="false" aria-controls="novaVaga"">Nova vaga</button>
</div>
<hr>
<div class="collapse" id="novaVaga"> 
    <div class="card">
        <div class="card-body">
            <form class="row g-3">
                <div class="col-md-6">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome">
                </div>
                <div class="col-md-2">
                    <label for="rs" class="form-label">R$</label>
                    <input type="rs" class="form-control" id="rs">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Modelo</label>
                    <select class="form-select" aria-label="Default select example">
                        <option value=""></option>
                        <option value="presencial">Presencial</option>
                        <option value="hibrido">Híbrido</option>
                        <option value="remoto">Remoto</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="nivel" class="form-label">Nível</label>
                    <select id="nivel" class="form-select" aria-label="Default select example">
                        <option value=""></option>
                        <option value="1">Ensino médio</option>
                        <option value="2">Técnico</option>
                        <option value="3">Superior</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="area" class="form-label">Área</label>
                    <select id="area" class="form-select" aria-label="Default select example" disabled>
                       
                        
                    </select>
                </div>

                <div class="col-md-6">
                    <div style="display: flex; flex-direction:column; margin-bottom:10px;">
                        <label for="email" class="form-label">Cursos</label>
                        <div id="selecCursos" class="btn btn-secondary disabled" data-bs-toggle="collapse" href="#selecionarCursosCollapse" role="button" aria-expanded="false" aria-controls="selecionarCursosCollapse">
                            Selecionar cursos
                        </div>
                    </div>

                    <div class="collapse" id="selecionarCursosCollapse">
                        <div class="card card-body" id="options">
                            
                        </div>
                    </div>
                
                </div>

                <div class="col-lg-12">
                    <label for="desc" class="form-label">Descrição</label>
                    <textarea id="desc" type="text" class="form-control"></textarea>
                </div>
                <div class="col-lg-12">
                    <label for="req" class="form-label">Requisitos</label>
                    <textarea id="req" type="text" class="form-control"></textarea>
                </div>

                <div class="col-md-12">
                    <button type='submit' onclick='salvarEmpresa()' class='btn btn-primary botao-edit'>
                        Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="../app/public/js/vagaEmpresa.js"></script>

<?php
$content = ob_get_clean(); 
$pageTitle = "Empresa"; 
include('../app/public/html/template.php'); 
?>