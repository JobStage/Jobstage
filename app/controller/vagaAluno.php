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
    
    foreach ($vagas as $value) {
        // Chama o método listarPergunta para pegar as perguntas da vaga atual
        $perguntasHtml = $this->listarPergunta($value['idVaga']);

        $html .= '
             <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                    <h3>' . $value['nome'] . '</h3>
                    </div>
                    <div class="card-body">
                            <div class="">
                                <img src="../app/public/img/empresa.png" width="40px" heigth="40px">
                                    ' . $value['nomeEmpresa'] . '
                            </div>
                        <div class="infoVaga" style="display: flex; flex-direction: row; justify-content: space-between; flex-wrap: wrap;">
                            <div class="">
                                <img src="../app/public/img/cifrao.png" width="40px" heigth="40px">
                                R$ ' . $value['salario'] . '
                            </div>
                            <div class="">
                                <img src="../app/public/img/pin.png" width="40px" heigth="40px">
                                ' . $value['nomeCidade'] . ' - ' . $value['nomeEstado'] . '
                            </div>
                            <div class="">
                                <img src="../app/public/img/pasta.png" width="40px" heigth="40px">
                                
                            </div>
                            <input type="hidden" value="' . $value['idVaga'] . '" id="idVaga">
                        </div>
                        <br>
                        <div class="row g-3">
                            <div>
                                <button class="btn btn-secondary col-md-12" data-bs-toggle="collapse" href="#verMais' . $value['idVaga'] . '" role="button" aria-expanded="false" aria-controls="verMais">Ver mais</button>
                            </div>
                        </div>
                        <div id="verMais' . $value['idVaga'] . '" class="collapse">
                            <!-- Conteúdo do colapso -->
                            <div class="descricao">
                                <h5>Descricao</h5>
                                <p>' . $value['descricao'] . '</p>
                            </div>
                            <div class="requisitos">
                                <h5>Requisitos</h5>
                                <p>' . $value['requisitos'] . '</p>
                            </div>
                            ' .$perguntasHtml .' <!-- Insere as perguntas aqui -->
                            <div>
                                <button class="btn btn-success col-md-12" onclick="candidatar(' . $value['id_empresa'] . ', ' . $value['idVaga'] . ')">Candidatar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        ';
    }

    return $html ? $html : '<div class="alert alert-info" role="alert"> Ainda não existem vagas com o seu perfil! </div>';
}
public function listarPergunta($idVaga){
    $html = '';
    $pergunta = $this->vagaModel->listarPerguntasPorVaga($idVaga);
    $resposta = $this->vagaModel->salvarRespostas('');
    if($pergunta ){
        $html .= '
        <style>
            * {
                margin: 0;
                padding: 0;
            }
            .rate {
                float: left;
                height: 46px;
                padding: 0 10px;
            }
            .rate:not(:checked) > input {
                position: absolute;
                top: -9999px;
            }
            .rate:not(:checked) > label {
                float: right;
                width: 1em;
                overflow: hidden;
                white-space: nowrap;
                cursor: pointer;
                font-size: 30px;
                color: #ccc;
            }
            .rate:not(:checked) > label:before {
                content: "★ ";
            }
            .rate > input:checked ~ label {
                color: #ffc700;
            }
            .rate:not(:checked) > label:hover,
            .rate:not(:checked) > label:hover ~ label {
                color: #deb217;
            }
            .rate > input:checked + label:hover,
            .rate > input:checked + label:hover ~ label,
            .rate > input:checked ~ label:hover,
            .rate > input:checked ~ label:hover ~ label,
            .rate > label:hover ~ input:checked ~ label {
                color: #c59b08;
            }
        </style>';
        foreach($pergunta as $value) {
            $html .= '
                <div class="pergunta">
                    <h5>Perguntas</h5>
                    <p>' . $value['pergunta'] . '</p>
        
                    <!-- Avaliação por estrelas -->
                    <div class="rate">
                        <input type="radio" id="star5_' . $idVaga . '" name="rate_' . $idVaga . '" value="5" onclick="enviarResposta(' . $idVaga. ', 5)" />
                        <label for="star5_' . $idVaga . '" title="5 stars">5 stars</label>
                        <input type="radio" id="star4_' . $idVaga . '" name="rate_' . $idVaga . '" value="4" onclick="enviarResposta(' . $idVaga . ', 4)" />
                        <label for="star4_' . $idVaga . '" title="4 stars">4 stars</label>
                        <input type="radio" id="star3_' . $idVaga . '" name="rate_' . $idVaga . '" value="3" onclick="enviarResposta(' . $idVaga . ', 3)" />
                        <label for="star3_' . $idVaga . '" title="3 stars">3 stars</label>
                        <input type="radio" id="star2_' . $idVaga . '" name="rate_' . $idVaga . '" value="2" onclick="enviarResposta(' . $idVaga . ', 2)" />
                        <label for="star2_' . $idVaga . '" title="2 stars">2 stars</label>
                        <input type="radio" id="star1_' . $idVaga . '" name="rate_' . $idVaga . '" value="1" onclick="enviarResposta(' . $idVaga . ', 1)" />
                        <label for="star1_' . $idVaga . '" title="1 star">1 star</label>
                    </div>
                </div>';
        }
        return $html;
    }

    return $html ? $html: '<div class="alert alert-info" role="alert"> Sem perguntas </div>';
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

public function enviarResposta( $resposta) { 
    if($this->vagaModel->salvarRespostas( $resposta)){
        $retorno = array('success' => true, 'tittle' => 'Sucesso', 'msg' => 'Respondido com sucesso', 'icon' => 'success');
        echo json_encode($retorno);
        return;
    }
    $retorno = array('success' => false, 'tittle' => 'Erro', 'msg' => 'Não foi possivel responder', 'icon' => 'error');
    echo json_encode($retorno);
    return;
}

// public function salvar($idVaga, $idAluno, $idPergunta, $valorResposta){
//     if(empty($valorResposta)){
//         return;
//     }

//     if($this->vagaModel->salvarRespostas($idVaga, $idAluno, $idPergunta, $valorResposta)){
//         $retorno = array('success' => true, 'tittle' => 'Sucesso!', 'msg' => 'Funcionário criado!', 'icon' => 'success');
//         echo json_encode($retorno);
//         return $retorno;
//     }
//     $retorno = array('success' => false, 'tittle' => 'Erro!', 'msg' => 'Erro ao responder!', 'icon' => 'error');
//     echo json_encode($retorno);
//     return $retorno;
// }
// public function candidatar($idVaga, $idEmpresa) {//caso nao dê certo descomentar o codigo acima
    
//     $respostas = isset($_POST['respostas']) ? $_POST['respostas'] : null;

//     if ($this->vagaModel->candidatar($idVaga, $_SESSION['id'], $idEmpresa, $respostas)) {
//         $retorno = array('success' => true, 'title' => 'Sucesso', 'msg' => 'Candidatado com sucesso', 'icon' => 'success');
//         echo json_encode($retorno);
//         return;
//     }
//     $retorno = array('success' => false, 'title' => 'Erro', 'msg' => 'Não foi possível se candidatar', 'icon' => 'error');
//     echo json_encode($retorno);
//     return;
// }

// public function verificarPerguntas($idVaga) {
//     if (isset($idVaga)) {
//         $perguntas = $this->vagaModel->listarPerguntasPorVaga($idVaga); // Chamando a função da model para listar perguntas

//         if (!empty($perguntas)) {
//             echo json_encode([
//                 'status' => 'success',
//                 'message' => 'Perguntas encontradas!',
//                 'data' => $perguntas
//             ]);
//         } else {
//             echo json_encode([
//                 'status' => 'empty',
//                 'message' => 'Nenhuma pergunta encontrada para esta vaga.'
//             ]);
//         }
//     } else {
//         echo json_encode([
//             'status' => 'error',
//             'message' => 'ID da vaga inválido.'
//         ]);
//     }
// }
/////////////////////////////////////////////
// public function enviarRespostas($idVaga, $respostas) {
//     $idAluno = $_SESSION['id']; // Obtendo o ID do aluno pela sessão
//     if (isset($idVaga) && isset($respostas)) {
//         if ($this->vagaModel->salvarRespostas($idVaga, $idAluno, $respostas)) {
//             $retorno = array('success' => true, 'title' => 'Sucesso', 'msg' => 'Respostas enviadas com sucesso!', 'icon' => 'success');
//             echo json_encode($retorno);
//             return;
//         }
//     }
//     $retorno = array('success' => false, 'title' => 'Erro', 'msg' => 'Erro ao enviar as respostas.', 'icon' => 'error');
//     echo json_encode($retorno);
// }
/////////////////////////////////////////////////////




// public function verificarPerguntas($idVaga) {
//     //header('Content-Type: application/json');

//     if (isset($idVaga)) {
//         $perguntas = $this->vagaModel->listarPerguntasPorVaga($idVaga);

//         if (!empty($perguntas)) {
//             echo json_encode([
//                 'status' => 'success',
//                 'message' => 'Perguntas encontradas!',
//                 'data' => $perguntas
//             ]);
//         } else {
//             echo json_encode([
//                 'status' => 'empty',
//                 'message' => 'Nenhuma pergunta encontrada para esta vaga.'
//             ]);
//         }
//     } else {
//         echo json_encode([
//             'status' => 'error',
//             'message' => 'ID da vaga inválido.'
//         ]);
//     }
// }
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
