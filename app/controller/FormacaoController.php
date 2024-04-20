<?php
require_once __DIR__ . '/../model/FormacaoModel.php';

class FormacaoController{
    private $formacaoModel;

    public function __construct() {
       $this->formacaoModel = new FormacaoModel();
    }

    public function criarFormacao(string $curso, string $setor, string $instituicao, string $nivel, $inicio, $fim, string $status, $arquivo) {
       $this->formacaoModel->criarFormacao($curso, $setor, $instituicao, $nivel, $inicio, $fim, $status, $arquivo);
    }

    public function editarFormacao(int $idFormacao, string $curso, string $setor, string $instituicao, string $nivel, $inicio, $fim, string $status, $arquivo = null, $nomeTemporario = null) {
        // se existir arquivo deleta o arquivo cadastrado do usuario para substituir
        if ($arquivo){
            $nomeArquivo = $this->formacaoModel->getMatricula(1, $idFormacao);
            
            // verifica o retorno do banco de dados se teve resultado (se não teve ele não deleta)
            if($nomeArquivo){
                $caminhoArquivoAtual = '../matricula/' . $nomeArquivo; // acessa o arquivo já cadastrado
                unlink($caminhoArquivoAtual); // deleta o arquivo
            }

            $caminho_upload = '../matricula/';
            // insere o novo arquivo no diretório
            move_uploaded_file($nomeTemporario, $caminho_upload . $arquivo); 
            
            $this->formacaoModel->editarFormacao(1, $idFormacao,  $curso,  $setor,  $instituicao,  $nivel, $inicio, $fim, $status, $arquivo);
            $retorno = array('success' => true, 'tittle' => 'Sucesso!', 'msg' => 'Formação atualizada', 'icon' => 'success');
            echo json_encode($retorno);
            return;
        }
    
        $this->formacaoModel->editarFormacao(1 ,$idFormacao,  $curso,  $setor,  $instituicao,  $nivel, $inicio, $fim, $status);
        $retorno = array('success' => true, 'tittle' => 'Sucesso!', 'msg' => 'Formação atualizada', 'icon' => 'success');
        echo json_encode($retorno);
        return;
    }    

    public function excluirFormacao(int $idFormacao) {
      
    }

    public function listarFormacao() {
        $html = '';
        $tabelaFormacao = $this->formacaoModel->getAllformacao();
       
        if($tabelaFormacao){
            $html .= '
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
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
                            <td>' . $value['id_formacao'] . '</td>
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

    public function getAllFormacao($id){
        return $this->formacaoModel->getAllformacao($id);
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $acao = $_POST['acao'];
    $id = $_POST['id'] ?? '';
    $formacao = new FormacaoController();
    switch($acao){
        case 'editar':
            $renomear = '';
            $nomeTemporario = '';
            $arquivo = $_FILES['file'] ?? '';
            if($arquivo){
                $nomeTemporario = $arquivo['tmp_name']; // pega o nome temporário do arquivo enviado
                if($arquivo['type'] == 'application/pdf'){
                    $renomear = md5(time()) . '.pdf';
                }else{
                    $retorno = array('success' => false, 'tittle' => 'Erro', 'msg' => 'Envie apenas arquivo PDF', 'icon' => 'Danger');
                    echo json_encode($retorno);
                    return;
                }
            }
            
            $formacao->editarFormacao($idFormacao = $_POST['idFormacao'], $curso = $_POST["curso"], $setor = $_POST["setor"], $instituicao = $_POST["instituicao"], $nivel = $_POST["nivel"], $inicio = $_POST["inicio"], $fim = $_POST["fim"], $status = $_POST["status"], $renomear, $nomeTemporario);
        break;
        case 'excluir':
            # code...
        break;
        case 'getAll':
            $response = $formacao->getAllFormacao($id);
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
    }
}