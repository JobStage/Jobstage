<?php
require_once "../controller/contratosController.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo = $_POST['acao'];
    $contratos = new contratosController();

    switch ($tipo) {
        case 'gerarContrato':
            $id = $_POST['id'];
            $contratos->gerarContratoAgencia($id);
            break;
        
        default:
            # code...
            break;
    }
  }