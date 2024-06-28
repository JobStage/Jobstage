<?php
session_start();
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
    <!-- <div class="curriculo">
        <div class="cabecalho">
            <p class="nome">Nome da silva</p>
            <div class="info-cabecalho">
                <p>10 anos</p>
                <p>solteiro</p>
                <p>cidade - UF</p>
            </div>
        </div>   
        <hr>
        <div class="contato">
            <p class="contato-titulo">
                Contato
            </p>
            <p><b>E-mail:</b> email aqui</p>
            <p><b>Linkedin:</b> Linkedin aqui</p>
            <p><b>Telefone:</b> Telefone aqui</p>
        </div>
        <hr>
        <div class="sobre">
            <p class="sobre-titulo"> Sobre </p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias animi illum praesentium ad. Sint itaque dignissimos cumque asperiores, dolores delectus porro quos nulla nostrum pariatur quibusdam! Culpa rem quod officiis.</p>
        </div>
        <hr>
        <div class="experiencia">
            <p class="experiencia-titulo"> Experiência profissional: </p>
            <p><b>Nome da empresa - Cargo</b></p>
            <p><b>Período:</b> 01/01/2021 - 01/01/2021</p>
            <p><b>Atividades Exercidas:</b></p>
            <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio fuga unde possimus ipsum, officia quaerat harum tempora, consectetur excepturi doloribus rerum officiis magni similique aspernatur incidunt est reiciendis consequuntur autem!</p>
        </div>
        <hr>
        <div class="formacao">
            <p class="formacao-titulo"> Formação acadêmica </p>
            <p>Curso - Instituição <b>status</b></p>
        </div>
        <hr>
        <div class="cursos">
            <p class="cursos-titulo"> Cursos Extras </p>
            <p>Nome (status) <b>instituição</b></p>
        </div>
    </div> -->
    <?= $curriculo->listarCurriculo()?>
</div>

<?php
$content = ob_get_clean(); 
$pageTitle = "Cursos"; 
include('../app/public/html/template.php');
?>