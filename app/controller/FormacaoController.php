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

    public function editarFormacao(int $idFormacao, string $curso, string $instituicao, string $nivelTecnico, int $duracao, string $status) {
       
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
    $id = $_POST['id'];

    $formacao = new FormacaoController();
    switch($acao){
        case 'editar':
            # code...
        break;
        case 'excluir':
            # code...
        break;
        case 'getAll':
            $response = $formacao->getAllFormacao($id);
            $arr = array( 'id_formacao' => $response['0']['id_formacao'],
                            'curso' => $response['0']['curso'],
                            'instituicao' => $response['0']['instituicao'], 
                            'nivel' => $response['0']['nivel'],
                            'duracao' => $response['0']['duracao'], 
                            'status' => $response['0']['status'],
                            'matricula' => $response['0']['matricula'], 
                            'id_aluno' => $response['0']['id_aluno'],
                        );
            echo json_encode($arr);
        break;
    }
}