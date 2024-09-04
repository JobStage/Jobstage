<?php
require_once __DIR__ . '/../model/contratosModel.php';

class contratosController{
    private $contratos;
    public function __construct() {
        $this->contratos = new contratosModel();
    }
    public function gerarContratoEmpresa($idAluno, $idVaga, $idEmpresa){
        if($this->contratos->gerarContratoEmpresaModel($idAluno, $idVaga, $idEmpresa)){
            $retorno = array('msg' => 'Solicitação enviada! Aguarde a geração de contrato.', 'icon' => 'success' , 'success' => true);
            echo json_encode($retorno);
            return $retorno;
        }
        $retorno = array('msg' => 'Erro na solicitação de criação de contrato!', 'icon' => 'error' , 'success' => false);
        echo json_encode($retorno);
        return $retorno;
    }
}