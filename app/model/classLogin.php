<?php

require_once __DIR__."/../config/conexao.php";


class Login
{
    private $conn;

    public function __construct()
    {
        $conexao = new Conexao();
        $this->conn = $conexao->conn();
    }

    public function loginAluno(string $emailAluno, string $senhaAluno)
    {
        $sql = "SELECT ID, email, senha FROM aluno WHERE email = :email AND senha = :senhaAluno";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $emailAluno);
        $stmt->bindParam(':senhaAluno', $senhaAluno);
        $stmt->execute();

      
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result === false) {
            
            return false;  
        }
        return $result['ID'];
    }
    public function loginEmpresa(string $emailEmpresa, string $senhaEmpresa)
    {
        $sql = "SELECT id_empresa, email, senha FROM empresa WHERE email = :email AND senha = :senha";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $emailEmpresa);
        $stmt->bindParam(':senha', $senhaEmpresa);
        $stmt->execute();

      
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result === false) {
            
            return false;  
        }
        return $result['id_empresa'];
    }

    public function loginAdmin(string $emailAluno, string $senhaAluno)
    {
        $sql = "SELECT ID, email, senha FROM admin WHERE email = :email AND senha = :senhaAluno";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $emailAluno);
        $stmt->bindParam(':senhaAluno', $senhaAluno);
        $stmt->execute();

      
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result === false) {
            
            return false;  
        }
        return $result['ID'];
    }
}

