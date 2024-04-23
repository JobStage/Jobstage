<?php
require_once "../model/EmpresaModel.php";

class EmpresaController{
    private int $idEmpresa; 
    private string $nome;
    private string $email; 
    private string $cnpj; 
    private string $contato; 
    private string $estado; 
    private string $cidade; 
    private string $cep; 
    private string $rua;
    private string $numero; 
    private $empresaModel;

    public function __construct(int $idEmpresa) {
        $this->empresaModel = new Empresa();
        $this->idEmpresa = $idEmpresa;
    } 

    public function editarEmpresa() {
        if(empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['cnpj']) || empty($_POST['contato']) || empty($_POST['estado']) || empty($_POST['cidade']) || empty($_POST['cep']) || empty($_POST['rua']) || empty($_POST['numero'])) {
            $retorno = array('success' => false, 'tittle' => 'Erro', 'msg' => 'Campos obrigatórios', 'icon' => 'warning');
            echo json_encode($retorno);
            return;
        }
        $this->nome = $_POST['nome'];
        $this->email = $_POST['email'];
        $this->cnpj = $_POST['cnpj'];
        $this->contato = $_POST['contato'];
        $this->estado = $_POST['estado'];
        $this->cidade = $_POST['cidade'];
        $this->cep = $_POST['cep'];
        $this->rua = $_POST['rua'];
        $this->numero = $_POST['numero'];
        $this->empresaModel->atualizar($this->idEmpresa, $this->nome, $this->email, $this->cnpj, $this->contato, $this->estado, $this->cidade, $this->cep, $this->rua, $this->numero);
        $retorno = array('success' => true, 'tittle' => 'Sucesso', 'msg' => 'Dados salvos!', 'icon' => 'success');
        echo json_encode($retorno);
        return;
    }

    public function getAll(){
        return $this->empresaModel->getAll(1);
    }

}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $acao = $_POST['acao'];
    $empresa = new EmpresaController(1);
    switch($acao){
        case 'getAll':
            $response = $empresa->getAll();
            $arr = array(   
                'id'=>$response['ID'],
                'nome'=>$response['nome'],
                'email'=>$response['email'],
                'cnpj'=>$response['cnpj'],
                'contato'=>$response['contato'],
                'estado'=>$response['estado'],
                'cidade'=>$response['cidade'],
                'cep'=>$response['CEP'],
                'rua'=>$response['rua'],
                'numero'=>$response['numero'],
                'cadastro'=>$response['cadastro_completo'],
            );
            echo json_encode($arr);
        break;
        case 'editar':
            $result = $empresa->editarEmpresa();
        break;
    }

}
