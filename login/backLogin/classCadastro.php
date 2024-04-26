<?php

require_once __DIR__ .'/../../app/config/conexao.php';


class Cadastro {
    private $conn;

    public function __construct() 
    {
      $conexao = new Conexao();
      $this->conn = $conexao->conn();
    }

    public function inserirAluno(string $email, string $senha) 
    {
        $sql = "INSERT INTO aluno (email, senha) VALUES (:email, :senha)";
        
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":senha", $senha);
        

        $stmt->execute();
        
    }

    public function getEmailAluno(string $email)
    {
        $sql = "SELECT email from aluno WHERE email = :email ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getEmailEmpresa(string $email)
    {
        $sql = "SELECT email from empresa WHERE email = :email ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
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

