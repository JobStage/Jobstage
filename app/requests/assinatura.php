<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
require_once '../controller/assinaturaController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $acao = $_POST['acao'];
    $tipo = $_POST['tipo'];
    $id = $_POST['id'] ?? '';
    $assinatura = $_POST['ass'] ?? '';
    $idContrato = $_POST['idContrato'] ?? '';
    $ass = new assinaturaController();
    switch($acao){
        case 'assinar':
            $ass->assinarContrato($id, $assinatura, $tipo, $idContrato);
        break;
    }
}