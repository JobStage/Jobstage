<?php
session_start();
require_once '../app/controller/contratosController.php';
$contratos = new contratosController();
ob_start(); 
?>

<div class="card" style="padding: 20px">
    <?= $contratos->listarContratoAssinatura($_GET['contrato']) ?>
</div>

<script src="../app/public/js/assinatura.js"></script>

<?php
$content = ob_get_clean(); 
$pageTitle = "Assinatura"; 
include('../app/public/html/template.php'); 
?>