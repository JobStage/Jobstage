<?php
session_start();
require_once '../app/controller/contratosController.php';
$contratos = new contratosController();
ob_start(); 
?>
<style>
    .linha {
    position: relative;
}

.linha::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 2px; 
    background-color: black; 
}

</style>
<div class="card">
    <?= $contratos->listarContrato($_GET['contrato']) ?>
</div>

<script src="../app/public/js/contratos.js"></script>

<?php
$content = ob_get_clean(); 
$pageTitle = "Ver contrato"; 
include('../app/public/html/template.php'); 
?>