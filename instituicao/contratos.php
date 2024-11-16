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
<div class="card">
    <?= $filial->lisarContratosParaAssinar($_SESSION['id']) ?> 
</div>

<script src="../app/public/js/"></script>

<?php
$content = ob_get_clean(); 
$pageTitle = "Filiais"; 
include('../app/public/html/template.php'); 
?>