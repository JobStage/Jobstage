<?php
require_once '../app/controller/EmpresaController.php';
$empresa = new EmpresaController();
ob_start();  
?>

<div class="card">
    <div class="card-body">
        <?= $empresa->listarEmpresa() // COLOCAR ID DO USUÁRIO PELA SESSÃO APÓS IMPLEMENTAÇÃO DE LOGIN ?> 
        <div class="collapse" id="novaEmpresa">
            <br>
            <div class="card card-body">
                <form class="row g-3">
                    <div class="col-md-6">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome">
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email">
                    </div>
                    <div class="col-md-6">
                        <label for="cnpj" class="form-label">CNPJ</label>
                        <input type="text" class="form-control" id="cnpj">
                    </div>
                    <div class="col-md-6">
                        <label for="contato" class="form-label">Contato</label>
                        <input type="text" class="form-control" id="contato">
                    </div>
                    <div class="col-md-6">
                        <label for="estado" class="form-label">Estado</label>
                        <input type="text" class="form-control" id="estado">
                    </div>
                    <div class="col-md-6">
                        <label for="cidade" class="form-label">Cidade</label>
                        <input type="text" class="form-control" id="cidade">
                    </div>
                    <div class="col-md-3">
                        <label for="cep" class="form-label">CEP</label>
                        <input type="text" class="form-control" id="cep">
                    </div>
                    <div class="col-md-6">
                        <label for="rua" class="form-label">Rua</label>
                        <input type="text" class="form-control" id="rua">
                    </div>
                    <div class="col-md-3">
                        <label for="num" class="form-label">Numero</label>
                        <input type="number" class="form-control" id="num">
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
$pageTitle = "Empresa"; 
include('../app/public/html/template.php'); 
?>