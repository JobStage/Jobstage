<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

require_once '../controller/vagaAluno.php';
require_once '../controller/FormacaoController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $tipo = $_POST['tipo'];  
    $listaVagas = new VagasController();
    switch ($tipo) {        
        case 'candidatar':
           $listaVagas->candidatar($_POST['idVaga'], $_POST['idEmpresa']);
            break;
        
        case 'enviarRespostas':
            $listaVagas->enviarRespostas($_POST['idVaga'], $_POST['respostas']);
            break;
        
        case 'verificarPerguntas':  // Ajustando para o nome correto
            $listaVagas->verificarPerguntas($_POST['idVaga']);
            break;
    }
}