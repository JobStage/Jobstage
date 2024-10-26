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
        case 'enviarResposta':
            $listaVagas->enviarResposta( $_POST['resposta']);
            break;
    }
}