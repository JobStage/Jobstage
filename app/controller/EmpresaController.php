<?php
require_once "../model/EmpresaModel.php";

class EmpresaController{ 
    private $empresaModel;

    public function __construct(int $idEmpresa) {
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
        if(empty($_POST['id']) || empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['cnpj']) || empty($_POST['contato']) || empty($_POST['estado']) || empty($_POST['cidade']) || empty($_POST['cep']) || empty($_POST['rua']) || empty($_POST['numero'])) {
            $retorno = array('success' => false, 'title' => 'Erro', 'msg' => 'Campos obrigatórios', 'icon' => 'warning');
            echo json_encode($retorno);
            return;
        }

        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $cnpj = $_POST['cnpj'];
        $contato = $_POST['contato'];
        $estado = $_POST['estado'];
        $cidade = $_POST['cidade'];
        $cep = $_POST['cep'];
        $rua = $_POST['rua'];
        $numero = $_POST['numero'];

        $this->empresaModel->atualizar($id, $nome, $email, $cnpj, $contato, $estado, $cidade, $cep, $rua, $numero);

        $retorno = array('success' => true, 'title' => 'Sucesso', 'msg' => 'Dados atualizados!', 'icon' => 'success');
        echo json_encode($retorno);
        return;
    }
}
