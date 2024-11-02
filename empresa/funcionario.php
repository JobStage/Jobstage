<?php
session_start();
require_once '../app/controller/funcionario.php';

$funcionario = new funcionarioController();

ob_start();  
?>
<div style="display: flex; justify-content: end; margin-top: 20px;">
    <button class="btn btn-primary" data-bs-toggle="collapse" href="#novaVaga" role="button" aria-expanded="false" aria-controls="novaVaga"">Novo funcionário</button>
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
                <div class="col-md-6">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="text" class="form-control" id="email">
                </div>
                <div class="col-md-12">
                    <label for="area" class="form-label">Setor</label>
                    <select id="area" class="form-select" aria-label="Default select example">
                       
                        
                    </select>
                </div>
                <div class="col-md-12">
                     <button type="submit" class="btn btn-success" id='salvar' onclick='save()'>Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<br>
<div class="card">
    <?= $funcionario->listarFuncionario($_SESSION['id']) ?>
</div>
<!-- MODAL -->
<div id="staticBackdrop" data-bs-backdrop="static" class="modal fade" tabindex="-1" aria-labelledby="modalEditar">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalEditar">
                    Editar Funcionario
                </h4>
            </div>
            <div class="modal-body">
                <form id="editForm" class="row g-3">
                    <div class="col-md-6">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome">
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="text" class="form-control" id="email">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success" id='salvarEdit' onclick="salvarEdicao()">Salvar alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="../app/public/js/funcionario.js"></script>
<style>
  /* style para criar um grid */
  .card {
        padding: 10px;
    }

    .conteudo-principal {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        align-items: center;
        text-align: center;
        background-color: #7474776b;
    }

    /* .icons {
        display: flex;
        justify-content: space-around;
    } */

</style>
<?php
$content = ob_get_clean(); 
$pageTitle = "Funcionario"; 
include('../app/public/html/template.php'); 
?>