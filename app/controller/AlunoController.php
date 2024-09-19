<?php
// if(!isset($_SESSION)) 
// { 
//     session_start(); 
// } 
require_once "../model/AlunoModel.php";

class AlunoController{
    private int $idAluno; 
    private string $nome;  
    private $dataNasc;
    private string $telefone; 
    private string $estadoCivil; 
    private string $cidade; 
    private string $estado; 
    private string $cep; 
    private string $rua; 
    private string $numero; 
    private string $linkedin; 
    private string $descricao; 
    private $alunoModel;

    public function __construct(int $idAluno) {
        $this->alunoModel = new AlunoModel(); // instanciando classe da model
        $this->idAluno = $idAluno;
    } 
     
    public function editarAluno() {
        if(empty($_POST['nome']) || empty($_POST['dataNascimento']) || empty($_POST['telefone']) || empty($_POST['estadoCivil']) || empty($_POST['cidade']) || empty($_POST['estado']) || empty($_POST['cep']) || empty($_POST['rua']) || empty($_POST['numero'])) {
            $retorno = array('success' => false, 'tittle' => 'Erro', 'msg' => 'Campos obrigatórios', 'icon' => 'warning');
            echo json_encode($retorno);
            return;
        }
        $this->nome = $_POST['nome'];
        $this->dataNasc = $_POST['dataNascimento'];
        $this->telefone = $_POST['telefone'];
        $this->estadoCivil = $_POST['estadoCivil'];
        $this->cidade = $_POST['cidade'];
        $this->estado = $_POST['estado'];
        $this->cep = $_POST['cep'];
        $this->rua = $_POST['rua'];
        $this->numero = $_POST['numero'];
        $this->linkedin = $_POST['linkedin'] ?? '';
        $this->descricao = $_POST['sobre'] ?? '';
        
        $this->alunoModel->atualizar($this->idAluno, $this->nome, $this->dataNasc, $this->telefone, $this->estadoCivil, $this->cidade, $this->estado, $this->cep, $this->rua, $this->numero, $this->linkedin, $this->descricao);
        $retorno = array('success' => true, 'tittle' => 'Sucesso', 'msg' => 'Dados salvos!', 'icon' => 'success');
        echo json_encode($retorno);
        return;
    }

    public function getAll(){
        return $this->alunoModel->getAll($this->idAluno);
    }

}