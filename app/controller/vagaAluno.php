<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

require_once __DIR__ . '/../model/vagasModel.php';
require_once __DIR__ . '/../controller/FormacaoController.php';

class VagasController{
  private $vagaModel;

  public function __construct() {
    $this->vagaModel = new Vagas();
}
// public function mostrarInformacaoVagas($idVaga){
//   $html = '';

//   foreach($this->vagaModel->getAllVagas($idVaga) as $value){
//       $html .= '
//           <div class="col-xl-6">
//               <div class="card">
//                   <div class="card-header">
//                   <h3>'.$value['nome'].'</h3>
//                   </div>
//                   <div class="card-body">
//                       <div class="infoVaga" style="display: flex; flex-direction: row; justify-content: space-between; flex-wrap: wrap;">
//                           <div class="">
//                               <img src="../app/public/img/cifrao.png" width="40px" heigth="40px">
//                               R$ '. $value['salario'] .'
//                           </div>
//                           <div class="">
//                               <img src="../app/public/img/formacao.png" width="40px" heigth="40px">
//                               '. $value['nomeNivel'] .'
//                           </div>
//                           <div class="">
//                              <img src="../app/public/img/pasta.png" width="40px" heigth="40px">
//                               '. $value['modeloVaga'] .'
//                               <input type="hidden" value="idVaga">
//                           </div>
//                       </div>
//                       <br>
//                       <div class="row g-3">
//                           <div class="col-6">
//                               <button class="btn btn-primary" style="width:100%" onclick="candidatarVaga('. $value['idVaga'] .')">Candidatar</button>
//                           </div>
//                       </div>
//                   </div>
//               </div>
//           </div>
//       ';
//   }
//   echo $html;
// }

public function listarVagas(){
    $formacao = new FormacaoController();
    $list = $formacao->getFormacao();   
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

// if ($_POST['tipo'] == 'getVagaDetails') {
//   $idVaga = $_POST['idVaga'];
//   $vagaDetails = $this->vagaModel->getVagaById($idVaga); // Supondo que exista um método getVagaById no modelo

//   if ($vagaDetails) {
//       echo json_encode(['success' => true, 'data' => $vagaDetails]);
//   } else {
//       echo json_encode(['success' => false]);
//   }
//   exit;
// }
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $tipo = $_POST['tipo'];  
    $listaVagas = new VagasController();
    switch ($tipo) {        
        case 'candidatar':
           $listaVagas->candidatar($_POST['idVaga'], $_POST['idEmpresa']);
            break;
    }
}