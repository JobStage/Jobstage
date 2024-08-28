<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

require_once '../controller/vagaEmpresaController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $tipo = $_POST['tipo'];
    $vaga = new VagaEmpresaController();

    switch($tipo){
        case 'criarVaga':
            $nome =  $_POST['nome'];
            $rs =  $_POST['rs'];
            $modelo =  $_POST['modelo'];
            $nivel =  $_POST['nivel'];
            $desc =  $_POST['desc'];
            $req =  $_POST['req'];
            $ensinoMedio =  $_POST['cursoMedio'] ?? null;
            $area =  $_POST['area'] ?? null;
            $perguntas = json_decode($_POST['perguntas']);
            $valoresSelecionados =  $_POST['cursos'] ?? null;
            
            $valoresSelecionados = $valoresSelecionados ? json_decode($valoresSelecionados, true) : null;
            $vaga->criarVaga($nome, $rs, $modelo, $nivel, $desc, $req, $area, $valoresSelecionados, $ensinoMedio, $perguntas);
        break;
        case 'excluir';
            $vaga->excluirVaga($_POST['idVaga']);
        break;
        case 'getEditVaga':
            $vaga->getEditVaga($_POST['id']);
        break;
        case 'atualizarVaga':
            $idVaga =  $_POST['id'];
            $nome =  $_POST['nome'];
            $rs =  $_POST['rs'];
            $modelo =  $_POST['modelo'];
            $desc =  $_POST['desc'];
            $req =  $_POST['req'];
            $valoresSelecionados =  $_POST['cursos'] ?? null;
            $valoresSelecionados = $valoresSelecionados ? json_decode($valoresSelecionados, true) : null;
            $vaga->atualizarVaga($idVaga, $nome, $rs, $modelo, $desc, $req, $valoresSelecionados);
        break;
    }
}