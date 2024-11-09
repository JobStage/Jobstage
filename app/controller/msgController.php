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
     if ($value['origem'] == 'msgAluno') {
        echo '<div class="card left alert alert-info" style="margin-right: auto;">
                ' . htmlspecialchars($value['msg']) . '
              </div><br>';
      } elseif ($value['origem'] == 'msgEmpresa') {
          echo '<div class="card left alert alert-warning" style="margin-left: auto;">
                  ' . htmlspecialchars($value['msg']) . '
                </div><br>';
      }
    }
  }

  public function listarConversas($idAluno){
    foreach($this->msgModel->listarConversas($idAluno) as $value ){

      echo '<a href="msg.php?id='.$value['idEmp'].'" target="_blank">
            <div class="card" style="padding: 10px; border: 1px solid #ccc; background-color: #f9f9f9; border-radius: 5px; font-size: 16px;">
                '. $value['nome'] .'
              </div>
            </a>';
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