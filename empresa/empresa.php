<?php
session_start();
require_once '../app/controller/EmpresaController.php';
require_once '../app/controller/CidadeEstado.php';
$estado = new CidadeEstado();
$empresa = new EmpresaController($_SESSION['id']);
ob_start();  
?>

<div class="card"> 
    <div class="card-body">
                <form class="row g-3">
                    <div class="col-md-6">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome">
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" disabled readonly>
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
                        <select class="form-select" id="estado" required>
                            <option value=''> </option>
                            <?php
                                $estado->listaEstado();
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="cidade" class="form-label">Cidade</label>
                        <select class="form-select" id="optionsListCidade" required>
                            <option value=''> </option>
                            
                        </select>
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
                        <button type='submit' onclick='salvarEmpresa()' class='btn btn-primary botao-edit'>
                            Salvar
                        </button>
                    </div>
                </form>
            </div>
        </div>
<script src="../app/public/js/dadosEmpresa.js"></script>

<?php
$content = ob_get_clean(); 
$pageTitle = "Empresa"; 
include('../app/public/html/template.php'); 
?>