<?php
session_start();
require_once '../app/controller/contratosController.php';
$contratos = new contratosController();

ob_start();  
?>


<div class="card">
    <div class="card-body">
        <div style="display: flex; flex-direction:column;">
            <?= $contratos->listarSolicitacoesContrato() ?> 
        </div>
    </div>
</div>
<script src="../app/public/js/contratos.js"></script>
<?php
$content = ob_get_clean(); 
$pageTitle = "Contratos"; 
include('../app/public/html/template.php'); 
?>
