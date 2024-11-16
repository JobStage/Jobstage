<?php
session_start();
require_once 'verificaSessao.php';
require_once '../app/controller/CurriculoController.php';
$curriculo = new CurriculoController();
ob_start(); 
?>
<style>
    .curriculo{
        display: flex;
        flex-direction: column;
    }
    .cabecalho{
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .contato, .sobre, .experiencia, .formacao, .cursos{
        display: flex;
        flex-direction: column;
    }

    .contato-titulo, .sobre-titulo, .experiencia-titulo, .formacao-titulo, .cursos-titulo{
        background-color:darkgrey;
        font-weight: bold;
        font-size: 20px;
    }

    .info-cabecalho{
        display: flex;
        flex-direction: row;
        justify-content: space-evenly;
        width: 90%;
        flex-wrap: wrap;
    }

    
</style>
<div class="card">
    <?= $curriculo->listarCurriculo()?>
</div>

<?php
$content = ob_get_clean(); 
$pageTitle = "Cursos"; 
include('../app/public/html/template.php');
?>