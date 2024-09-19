<?php
session_start();
require_once '../app/controller/contratosController.php';
$contratos = new contratosController();
ob_start(); 
?>

<div class="row g-3">
    <?= $contratos->getAllContratos($_SESSION['id']) ?>
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
        background-color: #7474776b;
    }
</style>
<?php
$content = ob_get_clean(); 
$pageTitle = "Contratos"; 
include('../app/public/html/template.php'); 
?>