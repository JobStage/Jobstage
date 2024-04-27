<?php

require_once "../config/conexao.php";
class Empresa{

    private $conn;

    public function __construct() {
        $conexao = new Conexao();
        $this->conn = $conexao->conn();
    }

    public function inserir( $nome, $cnpj, $contato, $estado, $cidade, $cep, $rua, $numero){
        $sql = $this->conn->prepare('INSERT INTO empresa (nome, email, cnpj, contato, estado, cidade,
                                    cep, rua, numero, cadastro_completo) 
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

}
