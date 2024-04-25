<?php

require_once "./app/config/conexao.php";

class Cadastro {
    private $conn;

    public function __construct() 
    {
      $conexao = new Conexao();
      $this->conn = $conexao->conn();
    }

    public function inserirAluno(string $email, string $senha) 
    {
        $sql = "INSERT INTO aluno (nome, email, senha) VALUES (:email, :senha)";
        
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":senha", $senha);
        

        $stmt->execute();
    }
    
    public function inserirEmpresa(string $email, string $senha) 
    {
        $sql = "INSERT INTO empresa (email, senha) VALUES (:email, :senha)";
        
        $stmt = $this->conn->prepare($sql);

        
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":senha", $senha);

        $stmt->execute();
    }

}

