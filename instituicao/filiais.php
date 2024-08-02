<?php
session_start();
require_once '../app/controller/filialController.php';
$filial = new FilialController();
ob_start(); 
?>
<style>
     /* style para criar um grid */
    .card {
        padding: 10px;
    }

    .conteudo-principal {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 20px;
        align-items: center;
        text-align: center;
        background-color: #7474776b;
    }

    .icons {
        display: flex;
        justify-content: space-around;
    }
</style>
<div style="display: flex; justify-content: end; margin-top: 20px;">
    <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Nova filial
    </button>
</div>
<hr>

<div class="card">
    <?= $filial->listaFiliais($_SESSION['id']) ?> 
</div>

<!-- MODAL -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Nova Filial</h1>
            </div>
            <div class="modal-body">
                <form class="row g-3">
                    <input type="hidden" value="idFilial"></input>
                    <div class="col-md-12">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome">
                    </div>
                    <br>
                    <h5>Selecione os níveis de ensino dessa instituição:</h5>
                    <br>
                    <div style="display: flex; justify-content:space-between; font-size:18px">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="medio">
                            <label class="form-check-label" for="medio">
                                Médio
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="2" id="tecnico">
                            <label class="form-check-label" for="tecnico">
                                Técnico
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="3" id="superior">
                            <label class="form-check-label" for="superior">
                                Superior
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="button" class="btn btn-danger" onclick="closeModal()">Cancelar</button>
                        <button type="button" class="btn btn-success" onclick="salvar()">Salvar</button>    
                    <div>
                <form>
            </div>
        </div>
    </div>
</div>



<script src="../app/public/js/filiais.js"></script>

<?php
$content = ob_get_clean(); 
$pageTitle = "Filiais"; 
include('../app/public/html/template.php'); 
?>