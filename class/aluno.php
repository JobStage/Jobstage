<?php

class Aluno{
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

    public function __construct(int $idAluno) {
        $this->idAluno = $idAluno;
    } 

    public function cadastrarAluno(string $nome, string $curso, int $semestre, string $email, string $senha, string $estadoCivil, string $telefone, string $linkedin, string $descricao, DateTime $dataNasc) {
        echo 'aluno cadastrado com sucesso! ID: ' . $this->idAluno . '<br>';
        echo 'NOME: ' . $nome . '<br>';
        echo 'CURSO: ' . $curso . '<br>';
        echo 'SEMESTRE: ' . $semestre . '<br>';
        echo 'EMAIL: ' . $email . '<br>';
        echo 'SENHA: ' . $senha . '<br>';
        echo 'ESTADO CIVIL: ' . $estadoCivil . '<br>';
        echo 'TELEFONE: ' . $telefone . '<br>';
        echo 'LINKEDIN: ' . $linkedin . '<br>';
        echo 'DESCRIÇÃO: ' . $descricao . '<br>';
        echo 'DATA DE NASCIMENTO: ' . $dataNasc->format('d-m-Y') . '<br>' ; // Formata a data de nascimento

    }

    public function editarAluno(int $idAluno) {
        echo 'informacoes do aluno ' . $idAluno .' foram editadas com sucesso!' . '<br>';
    }

    public function getId(): int{
        return $this->idAluno;
    }
}
