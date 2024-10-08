<?php
// if(!isset($_SESSION)) 
// { 
//     session_start(); 
// } 

require_once __DIR__ . '/../model/vagaEmpresaModel.php';

class VagaEmpresaController{
    private $vagaModel;

    public function __construct() {
        $this->vagaModel = new vagaEmpresaModel();
    }
    
    
    public function criarVaga($supervisor, $nome, $rs, $modelo, $nivel, $desc, $req, $area = null, $valoresSelecionados = null, $ensinoMedio= null, $perguntas = null){
        if($valoresSelecionados){
            $valoresSelecionados =  implode(',', $valoresSelecionados);
        }
       
        if($this->vagaModel->criarVaga($supervisor, $nome, $rs, $modelo, $nivel, $desc, $req, $_SESSION['id'], $area , $valoresSelecionados, $ensinoMedio, $perguntas)){
            $retorno = array('success' => true, 'tittle' => 'Sucesso!', 'msg' => 'Vaga criada com sucesso!', 'icon' => 'success');
            echo json_encode($retorno);
            return;
        }

       $retorno = array('success' => false, 'tittle' => 'Erro', 'msg' => 'Erro ao criar a vaga, tente novamente!', 'icon' => 'error');
       echo json_encode($retorno);
       return;
    }
    
    public function listarVagasEmpresa($idEmpresa){
        $html = '';
    
        foreach($this->vagaModel->getAllVagas($idEmpresa) as $value){
            $html .= '
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                        <h3>'.$value['nome'].'</h3>
                        </div>
                        <div class="card-body">
                            <div class="infoVaga" style="display: flex; flex-direction: row; justify-content: space-between; flex-wrap: wrap;">
                                <div class="">
                                    <img src="../app/public/img/cifrao.png" width="40px" heigth="40px">
                                    R$ '. $value['salario'] .'
                                </div>
                                <div class="">
                                    <img src="../app/public/img/formacao.png" width="40px" heigth="40px">
                                    '. $value['nomeNivel'] .'
                                </div>
                                <div class="">
                                   <img src="../app/public/img/pasta.png" width="40px" heigth="40px">
                                    '. $value['modeloVaga'] .'
                                </div>
                            </div>
                            <br>
                            <div class="row g-3">
                                <div class="col-6">
                                    <button class="btn btn-primary" style="width:100%" onclick="getEditarVaga('. $value['idVaga'] .')">Editar</button>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-danger" style="width:100%" onclick="excluirVaga('. $value['idVaga'] .')">Excluir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }
        echo $html;
    }

    public function excluirVaga($idVaga){
        if($this->vagaModel->excluirVaga($idVaga, $_SESSION['id'])){
            $retorno = array('success' => true, 'tittle' => 'Sucesso!', 'msg' => 'Vaga excluida com sucesso!', 'icon' => 'success');
            echo json_encode($retorno);
            return;
        }

        $retorno = array('success' => false, 'tittle' => 'Sucesso!', 'msg' => 'Erro ao excluir a vaga, tente novamente!', 'icon' => 'error');
        echo json_encode($retorno);
        return;
    }

    public function getEditVaga($id){
        $result = $this->vagaModel->getVagaFiltado($id);

        $array = array(
            'idVaga' =>$result['idVaga'],
            'nome'=>$result['nome'],  
            'salario'=>$result['salario'],  
            'nivel'=>$result['nivel'],  
            'setor'=>$result['setor'], 
            'cursos'=>$result['cursos'], 
            'modelo'=>$result['modelo'], 
            'descricao'=>$result['descricao'],  
            'requisitos'=>$result['requisitos'],  
            'id_empresa'=>$result['id_empresa'], 
            'nomeFunc'=>$result['nomeFunc'], 
            'pergunta'=>$result['pergunta'], 
        );
 
        echo json_encode($array);
        return $array;
    }

    public function atualizarVaga($idVaga, $nome, $rs, $modelo, $desc, $req, $valoresSelecionados = null){
        if($valoresSelecionados){
            $valoresSelecionados =  implode(',', $valoresSelecionados);
        }

        if($this->vagaModel->atualizarVaga($idVaga, $nome, $rs, $modelo, $desc, $req, $valoresSelecionados)){
            $retorno = array('success' => true, 'tittle' => 'Sucesso!', 'msg' => 'Vaga editada com sucesso!', 'icon' => 'success');
            echo json_encode($retorno);
            return;
        }

       $retorno = array('success' => false, 'tittle' => 'Erro', 'msg' => 'Erro ao editar a vaga, tente novamente!', 'icon' => 'error');
       echo json_encode($retorno);
       return;

    }
}