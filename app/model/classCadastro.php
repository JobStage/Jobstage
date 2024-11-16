<?php

require_once __DIR__."/../config/conexao.php";



class Cadastro {
    private $conn;
    private $conexao; 
    
    public function __construct() {
        $this->conexao = new Conexao();
        $this->conn = $this->conexao->conn(); 
    }

    public function inserirAluno(string $email, string $senha) {
        try {
            $sql = "INSERT INTO aluno (email, senha, tipo_usuario) VALUES (:email, :senha, 1)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":senha", $senha);
            $stmt->execute();

        }  catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
        
    }

    public function getEmailAluno(string $email){
        try {
            $sql = "SELECT email from aluno WHERE email = :email ";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;

        }  catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
    }

    public function getEmailEmpresa(string $email){
        try {
            $sql = "SELECT email from empresa WHERE email = :email ";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;

        }  catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
    }
    
    public function inserirEmpresa(string $email, string $senha) {
        try {
            $sql = "INSERT INTO empresa (email, senha, tipo_usuario) VALUES (:email, :senha, 2)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":senha", $senha);
            $stmt->execute();
            
        }  catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
    }
    public function getEmailInstituicao(string $email)
    {
        $sql = "SELECT email from instituicao WHERE email = :email ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    
    public function inserirInstituicao(string $email, string $senha) 
    {
        $sql = "INSERT INTO instituicao (email, senha) VALUES (:email, :senha)";
        
        $stmt = $this->conn->prepare($sql);

        
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":senha", $senha);

        $stmt->execute();
    }

}

