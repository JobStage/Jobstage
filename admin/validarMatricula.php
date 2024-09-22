<?php
session_start();
require_once '../app/controller/matricula.php';
$matricula = new matricula();

ob_start();  
?>


<div class="card">
    <div class="card-body">
        <div style="display: flex; flex-direction:column;">
            <?= $matricula->listarMatriculas() ?>
        </div>
    </div>
</div>
<script src="../app/public/js/matricula.js"></script>

<?php
$content = ob_get_clean(); 
$pageTitle = "Validar Matriculas"; 
include('../app/public/html/template.php'); 
?>
