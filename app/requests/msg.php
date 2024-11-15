<?php
require_once '../controller/msgController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo = $_POST['acao']?? null;
    $txt = $_POST['txt'] ?? null;
    $id = $_POST['id'] ?? null;
    $destino = $_POST['destino'] ?? null;

    $msg = new msgController();
    switch ($tipo) {
        case 'msgEmpresa':
           $msg->salvarMsgEmpresa($txt, $id, $destino);
        break;
            
        case 'msgAluno':  
            $msg->salvarMsgAluno($txt, $id, $destino);
        break;
        
        default:
            
        break;
    }
  }