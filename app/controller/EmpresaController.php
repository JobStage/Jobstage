<?php
require_once __DIR__ . "/../model/EmpresaModel.php";

class EmpresaController{ 
    private $empresaModel;

    public function __construct() {
        $this->empresaModel = new Empresa();
    } 

    public function inserirEmpresa() {
        if(empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['cnpj']) || empty($_POST['contato']) || empty($_POST['estado']) || empty($_POST['cidade']) || empty($_POST['cep']) || empty($_POST['rua']) || empty($_POST['numero'])) {
            $retorno = array('success' => false, 'tittle' => 'Erro', 'msg' => 'Campos obrigatórios', 'icon' => 'warning');
            echo json_encode($retorno);
            return;
        }
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $cnpj = $_POST['cnpj'];
        $contato = $_POST['contato'];
        $estado = $_POST['estado'];
        $cidade = $_POST['cidade'];
        $cep = $_POST['cep'];
        $rua = $_POST['rua'];
        $numero = $_POST['numero'];

        $this->empresaModel->inserir($nome, $email, $cnpj, $contato, $estado, $cidade, $cep, $rua, $numero);
        $retorno = array('success' => true, 'title' => 'Sucesso', 'msg' => 'Dados salvos!', 'icon' => 'success');
        echo json_encode($retorno);
        return;
    }

    public function atualizarEmpresa() {
        if(empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['cnpj']) || empty($_POST['contato']) || empty($_POST['estado']) || empty($_POST['cidade']) || empty($_POST['cep']) || empty($_POST['rua']) || empty($_POST['numero'])) {
            $retorno = array('success' => false, 'title' => 'Erro', 'msg' => 'Campos obrigatórios', 'icon' => 'warning');
            echo json_encode($retorno);
            return;
        }

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $cnpj = $_POST['cnpj'];
        $contato = $_POST['contato'];
        $estado = $_POST['estado'];
        $cidade = $_POST['cidade'];
        $cep = $_POST['cep'];
        $rua = $_POST['rua'];
        $numero = $_POST['numero'];

        $this->empresaModel->atualizar($nome, $email, $cnpj, $contato, $estado, $cidade, $cep, $rua, $numero);

        $retorno = array('success' => true, 'title' => 'Sucesso!', 'msg' => 'Dados atualizados!', 'icon' => 'success');
        echo json_encode($retorno);
        return;
    }

    public function getAll($idEmpresa){
        return $this->empresaModel->getAll($idEmpresa);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $acao = $_POST['acao'];
    $empresa = new EmpresaController();
    switch($acao){
        case 'getAll':
            $response = $empresa->getAll(1);
            $arr = array(
                'id'=>$response['id_empresa'],
                'nome'=>$response['nome'],
                'email'=>$response['email'],
                'cnpj'=>$response['cnpj'],
                'contato'=>$response['contato'],
                'estado'=>$response['estado'],
                'cidade'=>$response['cidade'],
                'cep'=>$response['cep'],
                'rua'=>$response['rua'],
                'numero'=>$response['numero'],
            );
            echo json_encode($arr);
            return $arr;
        break;
        case 'editar':
            $result = $empresa->atualizarEmpresa();
        break;
    }
}