<?php
session_start();
require_once 'verificaSessao.php';
require_once '../app/controller/contratosController.php';
$contratos = new contratosController();

// $contratos->verificaSeTemContratoParaAssinatura($_SESSION['id'], 'aluno');
ob_start(); 
?>

<div class="card" style="padding: 20px">
    <?= $contratos->listarContratoAssinaturaInst($_GET['id']) ?>
</div>

<script src="../app/public/js/assinatura.js"></script>

<?php
$content = ob_get_clean(); 
$pageTitle = "Assinatura"; 
include('../app/public/html/template.php'); 
?>