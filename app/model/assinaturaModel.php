<?php
require_once __DIR__ .'/../config/conexao.php';

class assinaturaModel{
    private $conn;
    private $conexao; 
    
    public function __construct() {
        $this->conexao = new Conexao();
        $this->conn = $this->conexao->conn(); 
    }

    public function assinarContrato($idAluno, $assinatura, $tipoUsuario, $idContrato, $assinado) {
        try {
            $this->conn->beginTransaction();
    
            $sql = $this->conn->prepare("INSERT INTO assinatura (nome, idContratosEstagio, usuarioAssinado, dataHora)
                                          VALUES (:nome, :idContrato, :usuarioAssinado, :dataHora)");
            $dataHora = date('Y-m-d H:i:s');
            $sql->bindParam(':nome', $assinatura);
            $sql->bindParam(':idContrato', $idContrato);
            $sql->bindParam(':usuarioAssinado', $idAluno);
            $sql->bindParam(':dataHora', $dataHora); 
            $sql->execute();
    
            $lastInsertId = $this->conn->lastInsertId();
    
            if ($assinado) {
                echo 'true -> ' . $lastInsertId;
                $sql = $this->conn->prepare("UPDATE contratacoes
                                               SET assinado_{$tipoUsuario} = :id,
                                                   contratoAssinado = 1
                                               WHERE id = :idContrato");
                $sql->bindParam(':id', $lastInsertId);
                $sql->bindParam(':idContrato', $idContrato);
                $sql->execute();
            } else {
                echo 'false -> ' . $lastInsertId;
                $sql = $this->conn->prepare("UPDATE contratacoes
                                               SET assinado_{$tipoUsuario} = :id
                                               WHERE id = :idContrato");
                $sql->bindParam(':id', $lastInsertId); 
                $sql->bindParam(':idContrato', $idContrato);
                $sql->execute();
            }
    
            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            $this->conexao->logs($e);
            return false;
        }
    }
    

    public function verificaAssinaturas($idContrato){
        $sql = $this->conn->prepare("SELECT assinado_empresa, assinado_aluno, assinado_instituicao FROM contratacoes WHERE ID = :id");
        $sql->bindParam(':id', $idContrato);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);
    }
}

