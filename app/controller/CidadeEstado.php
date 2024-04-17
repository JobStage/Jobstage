<?php
require_once __DIR__ . '/../model/CidadeEstadoModel.php';

class CidadeEstado{
    private $cidadeEstadoModel;

    public function __construct() {
        $this->cidadeEstadoModel = new CidadeEstadoModel();
    }
    
    public function listaEstado(){
        foreach($this->cidadeEstadoModel->getAllEstados() as $value){
            echo '<option value='. $value['id'] .'>'. $value['nome'] .'</option>';
        }
    }

    public function listaCidade($estado = null){
        foreach($this->cidadeEstadoModel->listarCidades($estado) as $value){
            echo '<option value='. $value['id'] .'>'. $value['nome'] .'</option>';
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST['id'];  
    $cidadeEstado = new CidadeEstado();
    $cidadeEstado->listaCidade($id);
}