<?php
require_once "../controller/matricula.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo = $_POST['acao']?? null;
    $id = $_POST['idFormacao'] ?? null;

    $matricula = new matricula();
    switch ($tipo) {
        case 'aprovarMatricula':
            $matricula->aprovarMatricula($id);
        break;
            
        case 'reprovarMatricula':  
            $matricula->reprovarMatricula($id);
        break;
        
        default:
            
        break;
    }
  }