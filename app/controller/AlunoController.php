<?php
require_once "../model/Aluno.php";


class AlunoController{
    private int $idAluno; 
    private string $nome; 
    private string $curso; 
    private int $semestre; 
    private string $email; 
    private string $senha; 
    private string $estadoCivil; 
    private string $telefone; 
    private string $linkedin; 
    private string $descricao; 
    private $dataNasc;

    private $alunoModel;

    public function __construct(int $idAluno) {
        $alunoModel = new AlunoModel(); // instanciando classe da model
    } 

    public function cadastrarAluno(string $nome, string $curso, int $semestre, string $email, string $senha, string $estadoCivil, string $telefone, string $linkedin, string $descricao, DateTime $dataNasc) {

    }

    public function editarAluno(int $idAluno) {
       
    }

    public function getId(){
        $idUser = $this->alunoModel->getID(1);
        var_dump($idUser);
    }
}
