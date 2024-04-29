<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
require_once __DIR__ . '/../model/CursosModel.php';

class CursosController {
    private int $idCurso;
    private string $curso;
    private string $nivelTecnico;
    private string $instituicao;
    private $inicio;
    private $fim;
    private string $status;

    private $cursosModel;

    public function __construct() {
        $this->cursosModel = new CursosModel();
    }

    public function criarCurso(string $curso, string $instituicao, string $nivelTecnico, $inicio, $fim, string $status, int $idAluno) {
        if(empty($_POST['nome']) || empty($_POST['nivel']) || empty($_POST['instituicao']) || empty($_POST['inicio']) || empty($_POST['fim']) || empty($_POST['status'])) {
            $retorno = array('success' => false, 'tittle' => 'Erro', 'msg' => 'Campos obrigatórios', 'icon' => 'warning');
            echo json_encode($retorno);
            return;
        }

        if($this->cursosModel->salvarCurso($curso, $instituicao, $nivelTecnico, $inicio, $fim, $status,$idAluno)) {
            $retorno = array('tittle' => 'Sucesso', 'msg' => 'Curso cadastrado com sucesso!', 'icon' => 'success');
            echo json_encode($retorno);
            return $retorno;
        }
        $retorno = array('tittle' => 'erro', 'msg' => 'erro', 'icon' => 'danger');
        echo json_encode($retorno);
        echo 'qualquer coisa';
        return $retorno;
    }

    public function editarCurso(int $idAluno) {
        if(empty($_POST['nome']) || empty($_POST['nivel']) || empty($_POST['instituicao']) || empty($_POST['inicio']) || empty($_POST['fim']) || empty($_POST['status'])) {
            $retorno = array('success' => false, 'tittle' => 'Erro', 'msg' => 'Campos obrigatórios', 'icon' => 'warning');
            echo json_encode($retorno);
            return;
        }
        $this->idCurso = $_POST['idCurso'];
        $this->curso = $_POST['nome'];
        $this->nivelTecnico = $_POST['nivel'];
        $this->instituicao = $_POST['instituicao'];
        $this->inicio = $_POST['inicio'];
        $this->fim = $_POST['fim'];
        $this->status = $_POST['status'];
        $this->cursosModel->atualizar($this->idCurso, $this->curso, $this->instituicao,  $this->inicio, $this->fim, $this->status, $this->nivelTecnico, $idAluno);
        $retorno = array('success' => true, 'tittle' => 'Sucesso', 'msg' => 'Dados salvos!', 'icon' => 'success');
        echo json_encode($retorno);
        return;
    } 
    
    public function excluirCurso(int $idCurso, int $idAluno) {
        $resultDeleteCurso = $this->cursosModel->excluirCurso($idCurso, $idAluno);
        
        if($resultDeleteCurso){

            $retorno = array('success' => true, 'tittle' => 'Sucesso!', 'msg' => 'Formação excluída!', 'icon' => 'success');
            echo json_encode($retorno);
            return $retorno;
        }

        $retorno = array('success' => false, 'tittle' => 'Erro!', 'msg' => 'Não foi possível excluir o curso!', 'icon' => 'error');
        echo json_encode($retorno);
        return $retorno;

    }

    public function listarCursos() {
        $html = '';
        $tabelaCursos = $this->cursosModel->getAllcurso($_SESSION['id']);
       
        if($tabelaCursos){
            $html .= '
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Instituição</th>
                        <th scope="col">Inicio</th>
                        <th scope="col">Fim</th>
                        <th scope="col">Nível</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">';
                    foreach($tabelaCursos as $value){
                        $html .= '
                        <tr>
                            <td>' . $value['id_curso'] . '</td>
                            <td>' . $value['nome_curso'] . '</td>
                            <td>' . $value['instituicao'] . '</td>
                            <td>' . $value['inicio'] . '</td>
                            <td>' . $value['fim'] . '</td>
                            <td>' . $value['nivel'] . '</td>
                            <td>' . $value['status'] . '</td>
                            <td>
                                <button class="btn btn-primary" id="edit-'.$value['id_curso'].'" value='.$value['id_curso'].'>
                                    Editar
                                </button>
                                <button class="btn btn-danger" value='.$value['id_curso'].' onclick="excluirCurso('.$value['id_curso'].')">
                                    Excluir
                                </button>
                            </td>
                        </tr>';
                    }
                     $html .='
                </tbody>
            </table>';
        };
        return $html ? $html : '<div class="alert alert-danger" role="alert">Não foram encontrados cursos cadastrados!</div>';
    }

    public function getAllCurso(int $idAluno, $id){
        return $this->cursosModel->getAllcurso($idAluno,$id);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $acao = $_POST['acao'];
    $id = $_POST['id'] ?? '';
    $idAluno = $_SESSION['id'];
    $curso = new CursosController();
    switch($acao){
        case 'salvar':
            $curso->criarCurso($_POST['nome'], $_POST['instituicao'], $_POST['nivel'], $_POST['inicio'], $_POST['fim'], $_POST['status'],$idAluno);
            break;
        case 'editar':
            $curso->editarCurso($idAluno);
        break;
        case 'excluir':
           $curso->excluirCurso($_POST['idCurso'],$idAluno);
        break;
        case 'getAll':
            $response = $curso->getAllCurso($idAluno,$id);
            $arr = array( 'id_curso' => $response['0']['id_curso'],
                            'nome_curso' => $response['0']['nome_curso'],
                            'instituicao' => $response['0']['instituicao'],
                            'inicio' => $response['0']['inicio'],
                            'fim' => $response['0']['fim'],
                            'status' => $response['0']['status'],
                            'nivel' => $response['0']['nivel'],
                            'id_aluno' => $response['0']['id_aluno'],
                        );
            echo json_encode($arr);
        break;
    }
}