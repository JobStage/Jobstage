<?php
session_start();
require_once '../app/controller/CidadeEstado.php';
require_once '../app/controller/FilialController.php';
$estado = new CidadeEstado();
$filial = new FilialController();
ob_start(); 
?>
<h1>NOME DA FILIAL</h1>
<div class="card">
    <div class="card card-body">
        <form class="row g-3">
        <div class="col-lg-2">
                <label for="estado" class="form-label">Estado</label>
                <select class="form-select" id="estado" required>
                    <option value=''> </option>
                    <?php
                        $estado->listaEstado();
                    ?>
                </select>
            </div>
            <div class="col-lg-2">
                <label for="cidade" class="form-label">Cidade</label>
                <select class="form-select" id="optionsListCidade" required>
                    <option value=''> </option>
                    
                </select>
            </div>
            <div class="col-lg-2">
                <label for="CEP" class="form-label">CEP</label>
                <input type="text" class="form-control" id="CEP" required>
            </div>
            <div class="col-lg-6">
                <label for="Rua" class="form-label">Rua</label>
                <input type="text" class="form-control" id="Rua" required>
            </div>

            <hr>
            <?= $filial->listarCursosFilial($_GET['id']) ?>

            <div class="col-md-12">
                <button type="button" class="btn btn-success" onclick="salvarDadosFilial(<?= $_GET['id'] ?>)">Salvar</button>    
            <div>
        </form>
    </div>
</div>

<script src="../app/public/js/filiais.js"></script>

<?php
$content = ob_get_clean(); 
$pageTitle = "Ver Filiais"; 
include('../app/public/html/template.php'); 
?>