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
        $hash = md5($idEmpresa . time() . $idAluno . $idVaga);
        $vaga = $this->contratos->getDadosParaContatoModel($idVaga, $idAluno, $idEmpresa);
        
        foreach($vaga as $value){
            $textoDoContrato = '
                O aluno ' .$value['nomeAluno']. ' 
                que está no curso ' . $value['nomeCurso'] . ' 
                irá iniciar seu estagio com as atividades '. $value['descricaoVaga'] .'
                com salário de '. $value['salarioVaga'] .'
                na empresa '. $value['nomeEmpresa'] .'
                com o CNPJ: '. $value['cnpjEmpresa'].' 
                em '. $value['cidade'] . ' '.  $value['estado'] .'
            ';
        }

        if($this->contratos->gerarContratoModel($id, $textoDoContrato, $hash)){
            $retorno = array('tittle' => 'Sucesso!', 'msg' => 'O contrato de estágio foi gerado!', 'icon' => 'success' , 'success' => true);
            echo json_encode($retorno);
            return $retorno;
        }else{
            $retorno = array('tittle' => 'Erro!', 'msg' => 'Ocorreu um erro ao gerar um contrato!', 'icon' => 'error' , 'success' => false);
            echo json_encode($retorno);
            return $retorno;
        }
    }

    public function getAllContratos($idAluno){
        $html = '';
        $status = '';
        foreach($this->contratos->getContratos($idAluno) as $value){
            if($value['assinadoAluno'] == 0){
                $status .= '
                    <a href="assinatura.php?contrato='.$value['hashContrato'].'">
                        <img src="../app/public/img/elipse.png" width="20px" height="20px" style="margin-right: 5px;">
                    </a>'
                ;
            }elseif ($value['assinadoEmpresa'] == 0 || $value['assinadoInstituicao'] == 0) {
                $status .='<img src="../app/public/img/alerta.png" width="20px" height="20px" style="margin-right: 5px;">';
            }


            $html .= '
                    <div class="card">
                        <div class="conteudo-principal">
                            <div class="user">
                               '.$value['nome'].'
                            </div>
                            <div class="contrato">
                                Contrato: 
                                <a href="verContrato.php?contrato='.$value['hashContrato'].'">
                                    <img src="../app/public/img/anexo.png" width="20px" height="20px" style="margin-right: 5px;">
                                </a>
                            </div>
                             <div class="status">
                                Status: '.$status.'
                            </div>
                        </div>
                    </div>';
        }
        echo $html;
    }

    public function listarContrato($hash){
        $html = $this->contratos->getContratoPorHash($hash);
        echo '
            <div class="card" id="contrato-texto">
                '.$html['contrato'].'
            </div>';
    }

    public function listarContratoAssinatura($hash){
        $html = $this->contratos->getContratoPorHash($hash);

        echo '
            <div class="card">
                '.$html['contrato'].'
            </div>
            <br>
            <input type="text" id="ass" style="width:50%; height:60px; font-size:25px; align-self:center; font-family">
            
            <br>
            <button class="btn btn-primary">Assinar</button>
            ';
    }
}