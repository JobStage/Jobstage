<?php
require_once __DIR__ . '/../model/contratosModel.php';
require_once __DIR__ . '/../model/VagasModel.php';

class contratosController{
    private $contratos;
    private $dadosVaga;
    public function __construct() {
        $this->contratos = new contratosModel();
        $this->dadosVaga = new Vagas();
    }
    // funcao para a empresa slicitar um contrato
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
            foreach($solicitacoes as $value){
                $html .= '<div style="display: flex; flex-direction:row; justify-content:space-between; align-items:center">
                    <div>
                        '.$value["nome"].'
                    </div>
                    <div>
                        <div style="text-align-last: center;">
                            <b>PEDIDO</b>
                        </div>
                        <div>
                            Solicitação de contrato
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary" onclick="gerarContrato('.$value['ID'].')"> Gerar contrato </button>
                    </div>
                </div>';
            }
            return $html;
        }
        $html = '<div class="alert alert-info" role="alert">
                    Não existe nenhuma solicitação de contrato no momento!
                </div>';
        return $html;
    }

    public function getContratacoes($id){
       return $this->contratos->getContratoModel($id);
    }

    // funcao para a agencia gerar um contrato que foi solicitado pela empresa
    public function gerarContratoAgencia($id){
        $contratacao = $this->getContratacoes($id);
        $idVaga = $contratacao['idVaga'];
        $idAluno = $contratacao['idAluno'];
        $idEmpresa = $contratacao['idEmpresa'];

        $vaga = $this->contratos->getDadosParaContatoModel($idVaga);

        $this->contratos->gerarContratoModel($idVaga, $idAluno, $idEmpresa, $id);

    }
}