<?php
require_once __DIR__ .'/../config/conexao.php';

class assinaturaModel{
    private $conn;
    private $conexao; 
    
    public function __construct() {
        $this->conexao = new Conexao();
        $this->conn = $this->conexao->conn(); 
    }

    public function assinarContrato($idAluno, $assinatura, $tipoUsuario, $idContrato){
        try {
            $sql = $this->conn->beginTransaction();

            // insere a assinatura
            $sql = $this->conn->prepare("INSERT INTO assinatura (nome, idContratosEstagio, usuarioAssinado, dataHora)
                                                VALUES (:nome, :idContrato, :usuarioAssinado, :dataHora)");
            $dataHora =  date('Y-m-d H:i:s');
            $sql->bindParam(':nome', $assinatura);
            $sql->bindParam(':idContrato', $idContrato);
            $sql->bindParam(':usuarioAssinado', $idAluno);
            $sql->bindParam(':dataHora', $dataHora); 
            $sql->execute();

           
            $lastInsertId = $this->conn->lastInsertId();

            // atualiza a tabela de contratos
            $sql = $this->conn->prepare("UPDATE contratacoes
                                                SET assinado_{$tipoUsuario} = :id
                                                WHERE id = :idContrato");

            $sql->bindParam(':id', $lastInsertId);
            $sql->bindParam(':idContrato', $idContrato);
            $sql->execute();

            $sql = $this->conn->commit();

            return true;
        } catch (Exception $e) {
            $sql = $this->conn->rollBack();
            $this->conexao->logs($e);
            return false;
            return false;
        }
    }
}

