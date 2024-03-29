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

    public function __construct() {
       
    } 

    public function cadastrarAluno(string $nome, string $curso, int $semestre, string $email, string $senha, string $estadoCivil, string $telefone, string $linkedin, string $descricao, DateTime $dataNasc) {
       
    }

    public function editarAluno(int $idAluno) {
        
    }
}
