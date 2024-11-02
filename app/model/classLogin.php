<?php

require_once __DIR__."/../config/conexao.php";


class Login
{
    private $conn;
    private $conexao; 
    
    public function __construct() {
        $this->conexao = new Conexao();
        $this->conn = $this->conexao->conn(); 
    }

    public function loginAluno(string $emailAluno, string $senhaAluno){
        try {
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
        }  catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
        
    }
    public function loginEmpresa(string $emailEmpresa, string $senhaEmpresa){
        try {
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
        }  catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
    }

    public function loginAdmin(string $emailAluno, string $senhaAluno){
        try {
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
        }  catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
    }
}

