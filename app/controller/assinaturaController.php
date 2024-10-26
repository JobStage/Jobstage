<?php
require_once __DIR__ . '/../model/assinaturaModel.php';


class assinaturaController{
   private $assinaturaModel;

    public function __construct() {
        $this->assinaturaModel = new assinaturaModel();
    }
   
    public function assinarContrato($idAluno, $assinatura, $tipo, $idContrato){
        $a = $this->assinaturaModel->verificaAssinaturas($idContrato);
        $assinado = false;

        if($a['assinado_empresa'] && $a['assinado_instituicao'] || $a['assinado_empresa'] && $a['assinado_aluno'] || $a['assinado_aluno'] && $a['assinado_instituicao']){
            $assinado = true;
        }
        if($this->assinaturaModel->assinarContrato($idAluno, $assinatura, $tipo, $idContrato, $assinado)){
            $retorno = array('tittle' => 'Sucesso', 'msg' => 'Contrato assinado!', 'icon' => 'success', 'sucesso' => true);
            echo json_encode($retorno);
            return $retorno;
        }
        $retorno = array('tittle' => 'Erro', 'msg' => 'Erro ao assinar o contrato!', 'icon' => 'error', 'sucesso' => true);
        echo json_encode($retorno);
        return $retorno;
    }
}