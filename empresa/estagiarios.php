<?php
session_start();
require_once '../app/controller/contratosController.php';
$contratos = new contratosController();
ob_start(); 
?>

<div>
    <?= $contratos->listarAlunosContratados($_SESSION['id']) ?>
</div>



<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Contratos</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="contratos" style="display: flex; justify-content:space-evenly; align-items: center;">
            <div class="contratoEstagio" style="display:flex; flex-direction:column; align-items:center" >
                <p>Contrato estágio</p>
                <a href="verContrato.php?idContrato=" id="verContratoLink">
                    <img src="../app/public/img/anexo.png" width="50px" height="50px">
                </a>
            </div>
            <div class="contratoEstagio" style="display:flex; flex-direction:column; align-items:center" >
                <p>Relatórios</p>
                <a href="relatorios.php?idAluno=" id="verRelatorioLink">
                    <img src="../app/public/img/anexo.png" width="50px" height="50px">
                </a>    
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>


<style>
     /* style para criar um grid */
    .card {
        padding: 10px;
    }

    .conteudo-principal {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        background-color: #7474776b;
    }
    
</style>

<script src="../app/public/js/contratos.js"></script>
<?php
$content = ob_get_clean(); 
$pageTitle = "Contratos"; 
include('../app/public/html/template.php'); 
?>