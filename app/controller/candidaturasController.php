<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

require_once __DIR__ . '/../model/vagasModel.php';
require_once __DIR__ . '/../controller/FormacaoController.php';

class CandidaturasController{
    private $vagaModel;

    public function __construct() {
        $this->vagaModel = new Vagas();
    
    }

    public function listarCandidaturasAluno(){
        $formacao = new FormacaoController();
        $list = $formacao->getFormacao();   
        $idCurso = $list['curso']?? null;
        $html = '';
        $vagas = $this->vagaModel->vagasCandidatadas($idCurso, $_SESSION['id']);

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
                            <br>
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
                                    '.$value['modeloVaga'].'
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
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }
        return $html ? $html: '<div class="alert alert-info" role="alert"> Você não se candidatou para nenhuma vaga! </div>';
    }

    public function listarCandidaturasEmpresa(){
        $html = '';
    
        foreach($this->vagaModel->candidaturasEmpresa($_SESSION['id']) as $value){
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
                               <div class="col-12">
                                    <button class="btn btn-primary" style="width:100%" onclick=window.location.href="candidaturas02.php?id='.$value['idVaga'].'">Ver candidaturas</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            ';
        }
        echo $html;
    }

    public function candidatosVaga($idVaga) {
        $html = '';
        $testeCandt = $this->vagaModel->getCandidatosVagas($idVaga, $_SESSION['id']);
        // echo '<pre>';
        // var_dump($testeCandt);
        // echo '<pre>';   
        // die;
        foreach($this->vagaModel->getCandidatosVagas($idVaga, $_SESSION['id']) as $value) {
            $html .= '<div class="card">
    <div class="conteudo-principal">
        <div class="user">
            <h5>'.$value['nomeUsuario'].'</h5>
            <p>'.$value['idade'].'</p>
        </div>
        <div class="formacao">
            <h5>'.$value['curso'].'</h5>
            <p>'.$value['dataFormacao'].'</p>
        </div>
        <div class="icons">
            <img src="https://cdn-icons-png.flaticon.com/512/1828/1828885.png" width="48px" height="48px" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            <img src="https://cdn-icons-png.flaticon.com/512/4543/4543567.png" width="48px" height="48px" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            <img src="https://cdn-icons-png.flaticon.com/512/5063/5063960.png" width="48px" height="48px">
            <img src="https://cdn-icons-png.flaticon.com/512/6964/6964169.png" width="48px" height="48px">
        </div>
    </div>
    <div class="more-info">
        <div class="collapse" id="collapseExample">
            Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
        </div>
    </div>
</div>';
        }
        echo $html;
    }
}