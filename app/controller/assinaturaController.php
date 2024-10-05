<?php
require_once __DIR__ . '/../model/assinaturaModel.php';


class assinaturaController{
   private $assinaturaModel;

    public function __construct() {
        $this->assinaturaModel = new assinaturaModel();
    }
   
    public function assinarContrato($idAluno, $assinatura, $tipo, $idContrato){
        if($this->assinaturaModel->assinarContrato($idAluno, $assinatura, $tipo, $idContrato)){
            echo 'assinado';
            return;
        }
        // echo 'assinatura de contrato id do aluno -> ' . $idAluno . ' Assinatura: ' . $assinatura.'';
    }
}