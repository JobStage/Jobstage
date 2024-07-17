<?php

require_once  __DIR__  .'/../config/conexao.php';

class FilialModel {

  private $conn; 
    
    public function __construct() {
        $conexao = new Conexao();
        $this->conn = $conexao->conn();
    }


    public function getAllFiliais($id){
        $sql = $this->conn->prepare("SELECT f.id_filial as id, f.nome AS nome, GROUP_CONCAT(n.nivel) AS niveis
                                         FROM filial as f
                                        INNER JOIN nivel as n 
                                        ON FIND_IN_SET(n.id, f.nivel) > 0
                                        WHERE id_instituicao = :id
                                        GROUP BY f.nome");
                            
        $sql->bindParam(':id', $id);
        $sql->execute();

        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function criarFilial($nome, $niveis, $id) {
        $sql = $this->conn->prepare("INSERT INTO filial (nome, nivel, id_instituicao) 
                                     VALUES (:nome, :niveis, :id)");
    
        $sql->bindParam(':nome', $nome);
        $sql->bindParam(':niveis', $niveis);
        $sql->bindParam(':id', $id);
    
        $sql->execute();
        return true;
    }
    
    public function getDadoFilial($id, $idInstituicao){
        $sql = $this->conn->prepare("SELECT nome, nivel, id_filial FROM filial
                                        WHERE id_filial = :id
                                        AND id_instituicao = :idINst");
        $sql->bindParam(':id', $id);
        $sql->bindParam(':idINst', $idInstituicao);
        $sql->execute();

        $result = $sql->fetch(PDO::FETCH_ASSOC);
        return $result;
    }


    public function editarFilial($nome, $nivel, $idInstituicao, $id){
        try {
            $sql = $this->conn->prepare("UPDATE filial
                                            SET nome = :nome,
                                                nivel = :nivel
                                            WHERE
                                                id_filial = :id
                                            AND 
                                                id_instituicao = :idInst");
        
            $sql->bindParam(':nome', $nome);
            $sql->bindParam(':nivel', $nivel);
            $sql->bindParam(':id', $id);
            $sql->bindParam(':idInst', $idInstituicao);
            $sql->execute();
            return true;
        
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
        
    }
}