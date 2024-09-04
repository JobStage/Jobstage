<?php
// if(!isset($_SESSION)) 
// { 
//     session_start(); 
// }
require_once __DIR__ . '/../model/ExperienciaModel.php';

class ExperienciaController {
   

    private $experienciaModel;

    public function __construct() {
        $this->experienciaModel = new ExperienciaModel();
    }

    public function criarExperiencia(int $idAluno, string $cargo, string $empresa, string $tipo, $inicio, $fim, string $atividades) {
      if(empty($_POST['empresa']) || empty($_POST['cargo']) || empty($_POST['inicio']) || empty($_POST['fim']) || empty($_POST['tipo']) || empty($_POST['atividade'])) {
        $retorno = array('success' => false, 'tittle' => 'Erro', 'msg' => 'Campos obrigatórios', 'icon' => 'warning');
        echo json_encode($retorno);
        return;
      }
      $result = $this->experienciaModel->salvarExperiencia($idAluno, $cargo, $empresa, $tipo, $inicio, $fim, $atividades);
        if($result) {
            $retorno = array('tittle' => 'Sucesso', 'msg' => 'Experiência cadastrado com sucesso!', 'icon' => 'success');
            echo json_encode($retorno);
            return $retorno;
        }
        $retorno = array('tittle' => 'erro', 'msg' => 'erro', 'icon' => 'danger');
        echo json_encode($retorno);
        echo 'qualquer coisa';
        return $retorno;
    }

    public function editarExperiencia(int $idAluno,int $idExperiencia) {
        if(empty($_POST['nome']) || empty($_POST['cargo']) || empty($_POST['inicio']) || empty($_POST['fim']) || empty($_POST['tipo']) || empty($_POST['atividade'])) {
            $retorno = array('success' => false, 'tittle' => 'Erro', 'msg' => 'Campos obrigatórios', 'icon' => 'warning');
            echo json_encode($retorno);
            return;
        }
        $this->experienciaModel->atualizar($idExperiencia,$_POST['nome'], $_POST['cargo'], $_POST['inicio'], $_POST['fim'], $_POST['tipo'], $_POST['atividade'],$idAluno);
        $retorno = array('success' => true, 'tittle' => 'Sucesso', 'msg' => 'Dados salvos!', 'icon' => 'success');
        echo json_encode($retorno);
        return;
    } 
    
    public function excluirExperiencia(int $idExp, int $idAluno) {
        $resultDeleteExp = $this->experienciaModel->excluirExperiencia($idExp, $idAluno);
        if($resultDeleteExp){

            $retorno = array('success' => true, 'tittle' => 'Sucesso!', 'msg' => 'Experiência excluída!', 'icon' => 'success');
            echo json_encode($retorno);
            return $retorno;
        }

        $retorno = array('success' => false, 'tittle' => 'Erro!', 'msg' => 'Não foi possível excluir a experiência!', 'icon' => 'error');
        echo json_encode($retorno);
        return $retorno;

    }

    public function listarExperiencia() {
        $html = '';
        $tabelaExperiencia = $this->experienciaModel->getAllExperiencia($_SESSION['id']);
       
        if($tabelaExperiencia){
            $html .= '
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Cargo</th>
                        <th scope="col">Empresa</th>
                        <th scope="col">Inicio</th>
                        <th scope="col">Fim</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">';
                    foreach($tabelaExperiencia as $value){
                        $html .= '
                        <tr>
                            <td>' . $value['cargo'] . '</td>
                            <td>' . $value['nome'] . '</td>
                            <td>' . $value['inicio'] . '</td>
                            <td>' . $value['fim'] . '</td>
                            <td>' . $value['tipo'] . '</td>
                            <td>
                                <button class="btn btn-primary" id="edit-'.$value['id_exp'].'" value='.$value['id_exp'].'>
                                    Editar
                                </button>
                                <button class="btn btn-danger" value='.$value['id_exp'].' onclick="excluirExperiencia('.$value['id_exp'].')">
                                    Excluir
                                </button>
                            </td>
                        </tr>';
                    }
                     $html .='
                </tbody>
            </table>';
        };
        return $html ? $html : '<div class="alert alert-danger" role="alert">Não foram encontradas experiências cadastradas!</div>';
    }

    public function getAllExperiencia(int $idAluno,$id){
        return $this->experienciaModel->getAllExperiencia($idAluno,$id);
    }
}
