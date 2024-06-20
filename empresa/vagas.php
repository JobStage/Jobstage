<?php
session_start();
require_once '../app/controller/vagaEmpresaController.php';

$vagas = new VagaEmpresaController();

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
                    <select id="modelo" class="form-select" aria-label="Default select example">
                        <option value=""></option>
                        <option value="1">Presencial</option>
                        <option value="2">Híbrido</option>
                        <option value="3">Remoto</option>
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
                        <div id="selecCursos" class="btn btn-secondary disabled" data-bs-toggle="collapse" data-bs-target=".multi-collapse" href="#selecionarCursosCollapse " role="button" aria-expanded="false" aria-controls="selecionarCursosCollapse avisoCursoCollapse">
                            Selecionar cursos
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6" style="display: flex; align-items: center;">
                        <div class="collapse multi-collapse" id="avisoCursoCollapse">
                            <div class="alert alert-info" role="alert">
                                <h5>Selecione os cursos do nível e área escolhida que você deseja que vejam a sua vaga de estágio!</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="collapse multi-collapse" id="selecionarCursosCollapse">
                            <div class="card card-body" id="options">
                            
                            </div>
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
                    <button type='submit' onclick='salvar()' class='btn btn-primary botao-edit'>
                        Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<br>
<div class="row g-3">
    <?= $vagas->listarVagasEmpresa($_SESSION['id']) ?>
</div>


<!-- MODAL -->
<div id="staticBackdrop" data-bs-backdrop="static" class="modal fade" tabindex="-1" aria-labelledby="modalEditar">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalEditar">
                    Editar Vaga
                </h4>
            </div>
            <div class="modal-body">
                <form id="editForm" class="row g-3">
                    <div class="col-md-12">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nomeEdit">
                    </div>
                    <div class="col-md-6">
                        <label for="rs" class="form-label">R$</label>
                        <input type="rs" class="form-control" id="rsEdit">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Modelo</label>
                        <select id="modeloEdit" class="form-select" aria-label="Default select example">
                            <option value=""></option>
                            <option value="1">Presencial</option>
                            <option value="2">Híbrido</option>
                            <option value="3">Remoto</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="nivel" class="form-label">Nível</label>
                        <select id="nivelEdit" class="form-select" aria-label="Default select example" disabled>
                            <option value="1">Ensino médio</option>
                            <option value="2">Técnico</option>
                            <option value="3">Superior</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="area" class="form-label">Área</label>
                        <select id="areaEdit" class="form-select" aria-label="Default select example" disabled>
                        
                            
                        </select>
                    </div>

                    <div class="col-md-6">
                        <div style="display: flex; flex-direction:column; margin-bottom:10px;">
                            <label for="selecCursosEdit" class="form-label">Cursos</label>
                            <div id="selecCursosEdit" class="btn btn-secondary disabled" data-bs-toggle="collapse" data-bs-target="#selecionarCursosCollapseEdit, #avisoCursoCollapseEdit"  role="button" aria-expanded="false" aria-controls="selecionarCursosCollapseEdit avisoCursoCollapseEdit">
                                Selecionar cursos
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6" style="display: flex; align-items: center;">
                            <div class="collapse multi-collapse" id="avisoCursoCollapseEdit">
                                <div class="alert alert-info" role="alert">
                                    <h5>Edite os cursos que você deseja que faça parte da sua vaga de estágio escolhendo uma das opções ao lado de acordo com o nivel e área selecionados!</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="collapse multi-collapse" id="selecionarCursosCollapseEdit">
                                <div class="card card-body" id="optionsEdit">
                                
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-12">
                        <label for="desc" class="form-label">Descrição</label>
                        <textarea id="descEdit" type="text" class="form-control"></textarea>
                    </div>
                    <div class="col-lg-12">
                        <label for="req" class="form-label">Requisitos</label>
                        <textarea id="reqEdit" type="text" class="form-control"></textarea>
                    </div>
                    <input type="hidden" id="idVaga">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success" id='salvarEdit' onclick="salvarEdicao()">Salvar alterações</button>
            </div>
        </div>
    </div>
</div>

<script src="../app/public/js/vagaEmpresa.js"></script>

<?php
$content = ob_get_clean(); 
$pageTitle = "Empresa"; 
include('../app/public/html/template.php'); 
?>