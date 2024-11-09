<?php
// if(!isset($_SESSION)) 
// { 
//     session_start(); 
// }
require_once __DIR__ . '/../model/msgModel.php';

class msgController{
  private $msgModel;
  public function __construct() {
    $this->msgModel = new msgModel();
   
  }

  public function listarMsg($idEmpresa, $idAluno){
    foreach($this->msgModel->listarMsg($idEmpresa, $idAluno) as $value ){
     if ($value['origem'] == 'Aluno') {
        echo '<div class="card left alert alert-info" style="margin-right: auto;">
                ' . htmlspecialchars($value['msg']) . '
              </div><br>';
    } elseif ($value['origem'] == 'Empresa') {
        echo '<div class="card left alert alert-warning" style="margin-left: auto;">
                ' . htmlspecialchars($value['msg']) . '
              </div><br>';
    }
    }
  }

  public function salvarMsgEmpresa($txt, $id, $destino){
    if($this->msgModel->salvarMsgEmpresa($txt, $id, $destino)){
      $retorno = array('sucesso'=> true);
      echo json_encode($retorno);
      return $retorno;
    }
    $retorno = array('sucesso'=> false);
    echo json_encode($retorno);
    return $retorno;
  }

  public function salvarMsgAluno($txt, $id, $destino){
    if($this->msgModel->salvarMsgAluno($txt, $id, $destino)){
      $retorno = array('sucesso'=> true);
      echo json_encode($retorno);
      return $retorno;
    }
    $retorno = array('sucesso'=> false);
    echo json_encode($retorno);
    return $retorno;
  }
 
}