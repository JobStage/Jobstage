<?php
// if(!isset($_SESSION)) 
// { 
//     session_start(); 
// } 
require_once __DIR__ . "/../model/EmpresaModel.php";

class EmpresaController{ 
    private $idEmpresa;
    private $empresaModel;

    public function __construct(int $idEmpresa) {
        $this->empresaModel = new Empresa();
        $this->idEmpresa = $idEmpresa;
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

        $this->empresaModel->atualizar($this->idEmpresa, $nome, $email, $cnpj, $contato, $estado, $cidade, $cep, $rua, $numero);

        $retorno = array('success' => true, 'title' => 'Sucesso!', 'msg' => 'Dados atualizados!', 'icon' => 'success');
        echo json_encode($retorno);
        return;
    }

    public function getAll(){
        return $this->empresaModel->getAll($this->idEmpresa);
    }
}
