<?php
session_start();
require_once '../app/controller/candidaturasController.php';
$candidatura = new CandidaturasController();
ob_start(); 
?>

<div class="row g-3">
    <?= $candidatura->listarCandidaturasAluno() ?>
</div>


<?php
$content = ob_get_clean(); 
$pageTitle = "Candidaturas"; 
include('../app/public/html/template.php'); 
?>