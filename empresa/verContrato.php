<?php
session_start();
require_once '../app/controller/contratosController.php';
$contratos = new contratosController();
ob_start(); 
?>

<div class="card">
    <?= $contratos->listarContrato($_GET['contrato']) ?>
</div>
<script src="../app/public/js/contratos.js"></script>

<?php
$content = ob_get_clean(); 
$pageTitle = "Ver contrato"; 
include('../app/public/html/template.php'); 
?>