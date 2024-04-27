<?php
require_once "../model/EmpresaModel.php";

class EmpresaController{ 
    private $empresaModel;

    public function __construct(int $idEmpresa) {
        $this->empresaModel = new Empresa();
    } 

    public function editarEmpresa() {
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
        echo json_encode($retorno);
        return;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $acao = $_POST['acao'];
    $empresa = new EmpresaController();
    switch($acao){
        case 'inserir':
            $result = $empresa->inserirEmpresa();
        break;
    }
}
