<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
require_once __DIR__ . '/../model/FormacaoModel.php';
require_once 'matricula.php';

class FormacaoController{
    private $formacaoModel;
    private $matricula;
 

    public function __construct() {
       $this->formacaoModel = new FormacaoModel();
       $this->matricula = new matricula();
     
    }


    public function criarFormacao(string $curso, string $setor, string $instituicao, string $nivel, $inicio, $fim, string $status, $arquivo, int $idAluno): array {
        $nomeArquivo = $this->matricula->inserirMatricula($arquivo);
        
        if($this->formacaoModel->criarFormacao($curso, $setor, $instituicao, $nivel, $inicio, $fim, $status, $nomeArquivo, $idAluno)){
            $retorno = array('tittle' => 'Sucesso', 'msg' => 'Formação cadastrada com sucesso!', 'icon' => 'success');
            echo json_encode($retorno);
            return $retorno;
        }    

        $retorno = array('tittle' => 'erro', 'msg' => 'erro', 'icon' => 'danger');
        echo json_encode($retorno);
        return $retorno;
    }


    public function editarFormacao(int $idAluno, int $idFormacao, string $curso, string $setor, string $instituicao, string $nivel, $inicio, $fim, string $status, $arquivo = null): array {        
        // se existir arquivo deleta o arquivo cadastrado do usuario para substituir
        if ($arquivo){
            $nomeArquivo = $this->formacaoModel->getMatricula($idAluno, $idFormacao);
            $nomeNovoArquivo = $this->matricula->atualizarMatricula($nomeArquivo, $arquivo);
        
            if($this->formacaoModel->editarFormacao($idAluno, $idFormacao,  $curso,  $setor,  $instituicao,  $nivel, $inicio, $fim, $status, $nomeNovoArquivo)){
                $retorno = array('success' => true, 'tittle' => 'Sucesso!', 'msg' => 'Formação atualizada', 'icon' => 'success');
                echo json_encode($retorno);
                return $retorno;
            }
        }

        $this->formacaoModel->editarFormacao($idAluno ,$idFormacao,  $curso,  $setor,  $instituicao,  $nivel, $inicio, $fim, $status);
        $retorno = array('success' => true, 'tittle' => 'Sucesso!', 'msg' => 'Formação atualizada', 'icon' => 'success');
        echo json_encode($retorno);
        return $retorno;
    }    


    public function excluirFormacao(int $idFormacao, int $idAluno) {
        $nomeMatricula = $this->formacaoModel->getMatricula($idAluno, $idFormacao);

        $resultDeleteFormacao = $this->formacaoModel->excluirFormacao($idFormacao, $idAluno);
        
        if($resultDeleteFormacao){
            $this->matricula->excluirMatricula($nomeMatricula);

            $retorno = array('success' => true, 'tittle' => 'Sucesso!', 'msg' => 'Formação excluída!', 'icon' => 'success');
            echo json_encode($retorno);
            return $retorno;
        }

        $retorno = array('success' => false, 'tittle' => 'Erro!', 'msg' => 'Não foi possível excluir a formação!', 'icon' => 'error');
        echo json_encode($retorno);
        return $retorno;

    }


    public function listarFormacao(): string {
        $idAluno = $_SESSION['id'];
        $html = '';
        $tabelaFormacao = $this->formacaoModel->getAllformacao($idAluno);
       
        if($tabelaFormacao){
            $html .= '
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Instituição</th>
                        <th scope="col">Nível</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">';
                    foreach($tabelaFormacao as $value){
                        $html .= '
                        <tr>
                            <td>' . $value['curso'] . '</td>
                            <td>' . $value['instituicao'] . '</td>
                            <td>' . $value['nivel'] . '</td>
                            <td>' . $value['status'] . '</td>
                            <td>
                                <button class="btn btn-primary" id="edit-'.$value['id_formacao'].'" value='.$value['id_formacao'].'>
                                    Editar
                                </button>
                                <button class="btn btn-danger" value='.$value['id_formacao'].' onclick="excluirFormacao('.$value['id_formacao'].')">
                                    Excluir
                                </button>
                            </td>
                        </tr>';
                    }
                     $html .='
                </tbody>
            </table>';
        };
        return $html ? $html : '<div class="alert alert-danger" role="alert">Não foram encontradas formações cadastradas!</div>';
    }

    
    public function getAllFormacao(int $id, int $idAluno): array{
        return $this->formacaoModel->getAllformacao($idAluno, $id );
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $acao = $_POST['acao'];
    $id = $_POST['id'] ?? '';
    $formacao = new FormacaoController($_SESSION['id']);
    switch($acao){
        case 'editar':
           $formacao->editarFormacao($_SESSION['id'], $idFormacao = $_POST['idFormacao'], $curso = $_POST["curso"], $setor = $_POST["setor"], $instituicao = $_POST["instituicao"], $nivel = $_POST["nivel"], $inicio = $_POST["inicio"], $fim = $_POST["fim"], $status = $_POST["status"], $arquivo = $_FILES['file'] ?? '');
        break;
        case 'excluir':
            $formacao->excluirFormacao($_POST['idFormacao'], $_SESSION['id']);
        break;
        case 'getAll':
            $response = $formacao->getAllFormacao($id, $_SESSION['id']);
            $arr = array( 'id_formacao' => $response['0']['id_formacao'],
                            'curso' => $response['0']['curso'],
                            'setor' => $response['0']['setor'], 
                            'instituicao' => $response['0']['instituicao'], 
                            'nivel' => $response['0']['nivel'],
                            'inicio' => $response['0']['inicio'], 
                            'fim' => $response['0']['fim'], 
                            'status' => $response['0']['status'],
                            'matricula' => $response['0']['matricula'], 
                            'id_aluno' => $response['0']['id_aluno'],
                        );
            echo json_encode($arr);
        break;
        case 'criar':
            if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
                $formacao->criarFormacao($curso = $_POST["curso"], $setor = $_POST["setor"], $instituicao = $_POST["instituicao"], $nivel = $_POST["nivel"], $inicio = $_POST["inicio"], $fim = $_POST["fim"], $status = $_POST["status"], $arquivo = $_FILES['file'], $_SESSION['id']);
            }
        break;
    }
}