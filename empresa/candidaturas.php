<?php
session_start();
require_once 'verificaSessao.php';
require_once '../app/controller/CandidaturasController.php';
$candidaturas = new CandidaturasController();
ob_start(); 
?>

<div class="row g-3">
    <?= $candidaturas->listarCandidaturasEmpresa() ?>
</div>


<?php
$content = ob_get_clean(); 
$pageTitle = "Candidaturas"; 
include('../app/public/html/template.php'); 
?>
