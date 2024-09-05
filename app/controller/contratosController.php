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

    public function listarSolicitacoesContrato(){
        $solicitacoes = $this->contratos->getAllSolicitacoesContratoModel();
        $html = '';
        if($solicitacoes){
            $html .= '<div style="display: flex; flex-direction:row; justify-content:space-between; align-items:center">
                <div>
                    empresa 
                </div>
                <div>
                    <div style="text-align-last: center;">
                        <b>PEDIDO</b>
                    </div>
                    <div>
                        tipo do pedido
                    </div>
                </div>
                <div>
                    <button class="btn btn-primary"> Gerar contrato </button>
                </div>
            </div>';
            return $html;
        }
        $html = '<div class="alert alert-info" role="alert">
                    Não existe nenhuma solicitação de contrato no momento!
                </div>';
        return $html;
    }
}