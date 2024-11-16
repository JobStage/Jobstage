<?php
session_start();
require_once 'verificaSessao.php';
require_once '../app/controller/candidaturasController.php';

$candidatos= new CandidaturasController();

ob_start();  
?>
<div class="card">
   <?=$candidatos->candidatosVaga($_GET['id'])?>
</div>

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
<script src="../app/public/js/vagaEmpresa.js"></script>
<?php
$content = ob_get_clean(); 
$pageTitle = "Dados pessoais"; 
include('../app/public/html/template.php'); 
?>