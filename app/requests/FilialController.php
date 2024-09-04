<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

require_once '../controller/FilialController.php';
require_once '../controller/CursosCadastrados.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $acao = $_POST['acao'];   
    $filial = new FilialController($_SESSION['id']);
    $valoresSelecionados =  $_POST['niveis'] ?? null;

    switch($acao){
        case 'criarFilial':
            $valoresSelecionados = $valoresSelecionados ? json_decode($valoresSelecionados, true) : null;

            $filial->criarFilial($_POST['nome'], $valoresSelecionados);
        break;
        case 'getDadosFilial':
            $filial->getDadosFilial($_POST['id']);
        break;
        case 'editarFilial':
            $valoresSelecionados = $valoresSelecionados ? json_decode($valoresSelecionados, true) : null;
            $filial->editarFilial($_POST['nome'], $_POST['id'], $valoresSelecionados);
        break;
    }



}

?>