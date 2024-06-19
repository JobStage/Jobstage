<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

require_once __DIR__ . '/../model/vagaEmpresaModel.php';

class VagaEmpresaController{
    private $vagaModel;

    public function __construct() {
        $this->vagaModel = new vagaEmpresaModel();
    }
    
    
    public function criarVaga($nome, $rs, $modelo, $nivel, $desc, $req, $area = null, $valoresSelecionados = null){
        if($valoresSelecionados){
            $valoresSelecionados =  implode(',', $valoresSelecionados);
        }
       
        if($this->vagaModel->criarVaga($nome, $rs, $modelo, $nivel, $desc, $req, $_SESSION['id'], $area , $valoresSelecionados)){
            $retorno = array('success' => true, 'tittle' => 'Sucesso!', 'msg' => 'Vaga criada com sucesso!', 'icon' => 'success');
            echo json_encode($retorno);
            return;
        }

       $retorno = array('success' => false, 'tittle' => 'Erro', 'msg' => 'Erro ao criar a vaga, tente novamente!', 'icon' => 'error');
       echo json_encode($retorno);
       return;
    }
    
}

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
            $area =  $_POST['area'] ?? null;
            $valoresSelecionados =  $_POST['cursos'] ?? null;

            $valoresSelecionados = $valoresSelecionados ? json_decode($valoresSelecionados, true) : null;
            $vaga->criarVaga($nome, $rs, $modelo, $nivel, $desc, $req, $area, $valoresSelecionados);
        break;
    }
}