<?php

require_once __DIR__ . "/../config/conexao.php";
class Empresa{
    private $conn;
    private $conexao; 
    
    public function __construct() {
        $this->conexao = new Conexao();
        $this->conn = $this->conexao->conn(); 
    }

    public function inserir($idEmpresa, $nome, $cnpj, $contato, $estado, $cidade, $cep, $rua, $numero){
        try {
            $sql = $this->conn->prepare('INSERT INTO empresa (nome, email, cnpj, contato, estado, cidade,
                                        cep, rua, numero, id_empresa) 
                                        VALUES (:nome, :email, :cnpj, :contato, :estado, :cidade,
                                        :cep, :rua, :numero, :id)');
            $sql->bindParam(':id', $idEmpresa);
            $sql->bindParam(':nome', $nome);
            $sql->bindParam(':cnpj', $cnpj);
            $sql->bindParam(':contato', $contato);
            $sql->bindParam(':estado', $estado);
            $sql->bindParam(':cidade', $cidade);
            $sql->bindParam(':cep', $cep);
            $sql->bindParam(':rua', $rua);
            $sql->bindParam(':numero', $numero);
            $sql->execute();

        }  catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
    }

    public function atualizar($idEmpresa, $nome, $email, $cnpj, $contato, $estado, $cidade, $cep, $rua, $numero){
        try {
            $sql = $this->conn->prepare('UPDATE empresa SET nome = :nome, email = :email, cnpj = :cnpj, contato = :contato, estado = :estado, cidade = :cidade, cep = :cep, rua = :rua, numero = :numero WHERE id_empresa = :id');
            $sql->bindValue(':id', $idEmpresa);
            $sql->bindParam(':nome', $nome);
            $sql->bindParam(':email', $email);
            $sql->bindParam(':cnpj', $cnpj);
            $sql->bindParam(':contato', $contato);
            $sql->bindParam(':estado', $estado);
            $sql->bindParam(':cidade', $cidade);
            $sql->bindParam(':cep', $cep);
            $sql->bindParam(':rua', $rua);
            $sql->bindParam(':numero', $numero);
            $sql->execute();

        }  catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
    }

    public function getAll($idEmpresa){
        try {
            $sql = $this->conn->prepare('SELECT * FROM empresa WHERE id_empresa = :id');
            $sql->bindParam(':id', $idEmpresa);
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            return $result;
           
        }  catch (Exception $e) {
            $this->conexao->logs($e);
            return false;
        }
    }
}