<?php
require_once __DIR__ . '/../model/contratosModel.php';
require_once __DIR__ . '/../model/VagasModel.php';
require_once __DIR__ . '/../../email.php';

class contratosController{
    private $contratos;
    private $email;
    private $dadosVaga;
    public function __construct() {
        $this->contratos = new contratosModel();
        $this->dadosVaga = new Vagas();
        $this->email = new email();
    }
    // funcao para a empresa slicitar um contrato
    public function gerarContratoEmpresa($idAluno, $idVaga, $idEmpresa){
        foreach($this->dadosVaga->getVagaById($idVaga) as $value){
            $funcionarioId = $value['id_funcionario'];
        }

        if($this->contratos->gerarContratoEmpresaModel($idAluno, $idVaga, $idEmpresa, $funcionarioId)){
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
        $idAluno = $contratacao['id_aluno'];
        $idEmpresa = $contratacao['id_empresa'];
        $hash = md5($idEmpresa . time() . $idAluno . $idVaga);
        $vaga = $this->contratos->getDadosParaContatoModel($idVaga, $idAluno, $idEmpresa);

        foreach($vaga as $value){
            $nomeFunc = $value['nomeFunc'];
            $emailFunc = $value['emailFunc'];
            $idFunc = $value['idFunc'];

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
            if($this->email->enviarEmailAssinaturaFuncionario($hash, $nomeFunc, $emailFunc, $idFunc)){
                $retorno = array('tittle' => 'Sucesso!', 'msg' => 'O contrato de estágio foi gerado!', 'icon' => 'success' , 'success' => true);
                echo json_encode($retorno);
                return $retorno;
            }
            
            $retorno = array('tittle' => 'Erro!', 'msg' => 'Ocorreu um erro ao gerar um contrato!', 'icon' => 'error' , 'success' => false);
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
            if($value['assinado_aluno'] == 0){
                $status = '
                    <a href="assinatura.php?contrato='.$value['hashContrato'].'">
                        <img src="../app/public/img/elipse.png" width="20px" height="20px" style="margin-right: 5px;">
                    </a>'
                ;
            }elseif ($value['assinado_empresa'] == 0 || $value['assinado_instituicao'] == 0) {
                $status ='<img src="../app/public/img/alerta.png" width="20px" height="20px" style="margin-right: 5px;">';
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
        $ass = '';
        $dataHora = '';
        $dados = [];
        foreach($this->contratos->getContratoPorHash($hash) as $value){
            $contrato = $value['contrato'];
            $ass .= '<div class="ass-item">' . $value['nomeAss'] . '</div>';
            $dataHora .= '<div class="dataHora-item">' . $value['dataHora'] . '</div>';
            $dados[] = [
                'nomeAss' => $value['nomeAss'],
                'dataHora' => $value['dataHora']
            ];
        }
        $html =  '
            <div class="card" id="contrato-texto">
                '.$contrato.'
                <div class="assinaturas" style="display: flex; flex-direction: row; justify-content: space-evenly">
                    <div>
                       ' . (isset($dados[0]['nomeAss']) ? $dados[0]['nomeAss'] : '') . '
                        <div class="linha"></div>
                    </div>
                    <div>
                       ' . (isset($dados[1]['nomeAss']) ? $dados[1]['nomeAss'] : '') . '
                        <div class="linha"></div>
                    </div>
                    <div>
                        ' . (isset($dados[2]['nomeAss']) ? $dados[2]['nomeAss'] : '') . '
                        <div class="linha"></div>
                    </div>
                </div>
                <div class="comprovanteAss" style="margin: 0 auto; padding-top: 50px;">
               ';

                    $dataHora = new DateTime($value['dataHora']);
                    foreach ($dados as $value) {
                        $html .= '<p><img src="../app/public/img/jobstage.png" width="40px" height="40px"> Contrato assinado digitalmente por <b>' . $value['nomeAss'] . '</b> em <b>' . $dataHora->format('d/m/Y H:i:s') . '</b></p>';
                    }

        $html .= '
                </div>
            </div>';

            echo $html;

    }

    public function listarContratoAssinatura($hash){
        foreach($this->contratos->getContratoPorHash($hash) as $value){
            $contrato = $value['contrato'];
            $idAluno = $value['idAluno'];
            $idContrato = $value['idContrato'];
           
        }
        echo '
            <div class="card">
                '.$contrato.'
            </div>
            <br>
            <input type="text" id="ass" style="width:50%; height:60px; font-size:25px; align-self:center; font-family">
            <input type="hidden" id="idContrato" value='.$idContrato.'>
            
            <br>
            <button class="btn btn-primary" onclick="assinaturaAluno('. $idAluno .')">Assinar</button>
            ';
    }

    public function listarContratoAssinaturaFunc($hash){
        foreach($this->contratos->getContratoPorHash($hash) as $value){
            $contrato = $value['contrato'];
            $idContrato = $value['idContrato'];
            $idFunc = $value['idFunc'];
        }
        echo '
            <div class="card">
                '.$contrato.'
            </div>
            <br>
            <input type="text" id="ass" style="width:50%; height:60px; font-size:25px; align-self:center; font-family">
            <input type="hidden" id="idContrato" value='.$idContrato.'>
            
            <br>
            <button class="btn btn-primary" onclick="assinaturaFunc('. $idFunc .')">Assinar</button>
            ';
    }

    public function verificaSeTemContratoParaAssinatura($id, $user){
        if(!$this->contratos->verificaSeTemAssinatura($id, $user)){
            header('Location: contratos.php');
        }
    }

    public function verificaSeTemContratoParaAssinaturaFuncionario($usuario){
       // criar funcao e verificar se existe contrato para assinar por parte do funcionario
    }

    public function listarAlunosContratados($id){
        $html = '';
        foreach($this->contratos->getAlunosContratados($id) as $value){
            $html .= '<div class="card">
                        <div class="conteudo-principal">
                            <div class="user">
                                <h5>'. $value['nomeAluno'] .'</h5>
                                <p></p>
                            </div>
                            <div class="formacao">
                                <h5>CONTRATO</h5>
                            <p>'. (empty($value['contratoAtivo']) ? 'Em andamento' : ($value['contratoAtivo'] == 1 ? 'Ativo' : 'Encerrado')) .'</p>
                            </div>
                            <input type="hidden" value="'. $value['ID'] .'" id="idContrato">
                            <input type="hidden" value="'. $value['id_aluno'] .'" id="id_aluno">
                            <input type="hidden" value="'. $value['hashContrato'] .'" id="hash">
                            <div class="icons" style="cursor:pointer;">
                                <img src="../app/public/img/anexo.png" width="48px" height="48px" id="abrirContratos">
                            </div>
                        </div>
                    </div>';
        }
        return $html ? $html : '<div class="alert alert-primary" role="alert">
  Você não contratou nenhum estagiário!
</div>';
    }
}