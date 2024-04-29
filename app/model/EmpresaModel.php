<?php

require_once __DIR__ . "/../config/conexao.php";
class Empresa{

    private $conn;

    public function __construct() {
        $conexao = new Conexao();
        $this->conn = $conexao->conn();
    }

    public function inserir($idEmpresa, $nome, $cnpj, $contato, $estado, $cidade, $cep, $rua, $numero){
        $sql = $this->conn->prepare('INSERT INTO empresa (nome, email, cnpj, contato, estado, cidade,
                                    cep, rua, numero, id_empresa) 
                                    VALUES (:nome, :email, :cnpj, :contato, :estado, :cidade,
                                    :cep, :rua, :numero, 1)');
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
    }

    public function atualizar($nome, $email, $cnpj, $contato, $estado, $cidade, $cep, $rua, $numero){
        $sql = $this->conn->prepare('UPDATE empresa SET nome = :nome, email = :email, cnpj = :cnpj, contato = :contato, estado = :estado, cidade = :cidade, cep = :cep, rua = :rua, numero = :numero WHERE id_empresa = :id');
        $sql->bindValue(':id', 1);
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
    }

    public function getAll($idEmpresa){
        $sql = $this->conn->prepare('SELECT * FROM empresa WHERE id_empresa = :id');

        $sql->bindParam(':id', $idEmpresa);

        $sql->execute();

        $result = $sql->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
}