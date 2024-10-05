<?php
require_once __DIR__ .'/../config/conexao.php';

class assinaturaModel{
    private $conn; 
    
    public function __construct() {
        $conexao = new Conexao();
        $this->conn = $conexao->conn();
    }

    public function assinarContrato($idAluno, $assinatura, $tipoUsuario, $idContrato){
        try {
            $sql = $this->conn->beginTransaction();

            $sql = $this->conn->prepare("INSERT INTO assinatura (nome, idContratosEstagio, usuarioAssinado, dataHora)
                                                VALUES (:nome, :idContrato, :usuarioAssinado, :dataHora)");

            $dataHora =  date('Y-m-d H:i:s');
            $sql->bindParam(':nome', $assinatura);
            $sql->bindParam(':idContrato', $idContrato);
            $sql->bindParam(':usuarioAssinado', $idAluno);
            $sql->bindParam(':dataHora', $dataHora); 
            $sql->execute();

            // Pega o último ID inserido
            $lastInsertId = $this->conn->lastInsertId();

            $sql = $this->conn->prepare("UPDATE contratosestagio
                                                SET assinado_{$tipoUsuario} = :id
                                                WHERE id = :idContrato");

            $sql->bindParam(':id', $lastInsertId);
            $sql->bindParam(':idContrato', $idContrato);
            $sql->execute();


            /*
            // colocar aqui outro sql para verificar se as outras colunas de assinatura estão preenchidas para verificar quando o contrato está totalmente assinado
            
            // CORRIGIR BANCO DE DADOS E COLOCAR O CONTRATOESTAGIO E CONTRATACOES NA MESMA TABELA
            
            
            
            
            
            
            
            
            
            
            */ 
            $sql = $this->conn->commit();

            return true;
        } catch (Exception $e) {
            $sql = $this->conn->rollBack();
            echo $e;
            return false;
        }
    }
}

