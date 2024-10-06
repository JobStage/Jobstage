<?php
// if(!isset($_SESSION)) 
// { 
//     session_start(); 
// } 

require_once __DIR__ . '/../model/vagasModel.php';
require_once __DIR__ . '/../controller/FormacaoController.php';

class VagasController{
  private $vagaModel;

  public function __construct() {
    $this->vagaModel = new Vagas();
}


public function listarVagas(){
    $formacao = new FormacaoController();
    $list = $formacao->getFormacao(); 
    if($list['matricula_valida'] !== 1){
        return '<div class="alert alert-danger" role="alert">
                    Termine o cadastro de sua <b>formação</b> e aguarde a validação de sua declaração de matrícula para ver as vagas de estágio!
                </div>';
    }  
    $idCurso = $list['curso'];
    $html = '';
    $vagas = $this->vagaModel->getAllVagas($idCurso, $_SESSION['id']);
    foreach($vagas as $value){
        $html .= '
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                    <h3>'.$value['nome'].'</h3>
                    </div>
                    <div class="card-body">
                            <div class="">
                                <img src="../app/public/img/empresa.png" width="40px" heigth="40px">
                                    '.$value['nomeEmpresa'].'
                            </div>
                        <div class="infoVaga" style="display: flex; flex-direction: row; justify-content: space-between; flex-wrap: wrap;">
                            <div class="">
                                <img src="../app/public/img/cifrao.png" width="40px" heigth="40px">
                                R$ '.$value['salario'].'
                            </div>
                            <div class="">
                                <img src="../app/public/img/pin.png" width="40px" heigth="40px">
                                '.$value['nomeCidade'].' - '.$value['nomeEstado'].'
                            </div>
                            <div class="">
                                <img src="../app/public/img/pasta.png" width="40px" heigth="40px">
                                
                            </div>
                            <input type="hidden" value="'.$value['idVaga'].'" id = "idVaga">
                        </div>
                        <br>
                        <div class="row g-3">
                            <div >
                                <button class="btn btn-secondary col-md-12" data-bs-toggle="collapse" href="#verMais'.$value['idVaga'].'" role="button" aria-expanded="false" aria-controls="verMais">Ver mais</button>
                        
                            </div>
                        </div>
                        <div id="verMais'.$value['idVaga'].'" class="collapse">
                            <!-- Conteúdo do colapso -->
                            <div class="descricao">
                                <h5>Descricao</h5>
                                <p>'.$value['descricao'].'</p>
                            </div>
                            <div class="requisitos">
                                <h5>Requisitos</h5>
                                <p>'.$value['requisitos'].'</p>
                            </div>
                            <div>
                                <button class="btn btn-success col-md-12" onclick="candidatar('.$value['id_empresa'].', '.$value['idVaga'].')">Candidatar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        ';
  }
  return $html ? $html: '<div class="alert alert-info" role="alert"> Ainda não existem vagas com o seu perfil! </div>';

}

public function candidatar($idVaga, $idEmpresa){
    if($this->vagaModel->candidatar($idVaga, $_SESSION['id'],$idEmpresa)){
        $retorno = array('success' => true, 'tittle' => 'Sucesso', 'msg' => 'Candidatado com sucesso', 'icon' => 'success');
        echo json_encode($retorno);
        return;
    }
    $retorno = array('success' => false, 'tittle' => 'Erro', 'msg' => 'Não foi possivel se candidatar', 'icon' => 'error');
    echo json_encode($retorno);
    return;
}
}