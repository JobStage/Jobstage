<?php
require_once "../controller/matricula.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo = $_POST['acao'];
    $id = $_POST['idFormacao'];
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